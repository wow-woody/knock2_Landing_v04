const SPREADSHEET_ID = '1lXbQMo7IyfVyRzq0JiV2-IncBegWYYBM3zaf1wSwhYY';
const RECENT_APPLICANTS_CACHE_KEY = 'recent_applicants';
const RECENT_APPLICANTS_CACHE_TTL_SECONDS = 60;
// 같은 IP가 이 시간(초) 이내에 재신청하면 막는다
const RATE_LIMIT_SECONDS = 300;



// 구글시트탭: 정상 저장(락 실패, 시트 없음, 기타 에러)에 실패했을 때 신청 데이터를 잃지 않도록 백업해두는 시트
const FALLBACK_SHEET_NAME = 'DB로스';



// 구글시트탭: 모든 신청을 모아두는 시트. 상담유형은 시트 탭이 아니라 이 시트의 '상담유형' 컬럼 값으로만 저장된다
const INTEGRATED_SHEET_NAME = '통합';


// 각 시트의 1행(헤더) 순서. 여기 배열만 바꾸면(칸 추가/순서 변경) 실제 데이터도 헤더 이름 기준으로 알아서 맞는 열에 들어간다

//구글시트탭: DB로스 탭 헤더이름 순서
const FALLBACK_SHEET_HEADERS = ['번호', '신청시간', '이름', '연락처', '상담유형', '유실사유'];

//구글시트탭: 일반 탭 헤더이름 순서
const INTEGRATED_SHEET_HEADERS = ['번호', '신청시간', '이름', '연락처', '상담유형'];

// 시트가 없으면 만들고, 비어있으면 헤더 행을 써준다
function getOrCreateSheetWithHeaders(spreadsheet, sheetName, headers) {
    let sheet = spreadsheet.getSheetByName(sheetName);

    if (!sheet) {
        sheet = spreadsheet.insertSheet(sheetName);
    }

    if (sheet.getLastRow() === 0) {
        sheet.appendRow(headers);
    }

    return sheet;
}

// 시트 1행(헤더)을 읽어서 { 헤더이름: 열번호(1부터 시작) } 형태로 돌려준다
// 실제 헤더 개수(getLastColumn())를 별도로 조회하면 왕복 호출이 하나 더 늘어나므로,
// 충분히 넉넉한 고정 너비로 한 번에 읽고 빈 칸은 무시한다 (현재 시트는 헤더가 5~6개뿐)
const MAX_HEADER_COLUMNS = 20;

function getHeaderColumnIndexes(sheet) {
    const headerRow = sheet.getRange(1, 1, 1, MAX_HEADER_COLUMNS).getValues()[0];
    const indexByName = {};

    headerRow.forEach((headerName, i) => {
        const trimmed = String(headerName).trim();
        if (trimmed) {
            indexByName[trimmed] = i + 1;
        }
    });

    return indexByName;
}

// { 헤더이름: 값 } 객체를 받아서, 실제 헤더 순서에 맞춰 한 행으로 추가한다. 헤더 순서가 바뀌어도 이 함수를 쓰는 코드는 그대로 둬도 된다
// indexByName은 호출부에서 이미 읽어온 값을 넘겨받는다 (매 호출마다 헤더를 다시 읽으면 그만큼 왕복 호출이 늘어남)
function appendRowByHeader(sheet, valuesByHeader, indexByName) {
    const columnCount = Math.max(0, ...Object.values(indexByName));
    const rowArray = new Array(columnCount).fill('');

    Object.keys(valuesByHeader).forEach((headerName) => {
        const columnIndex = indexByName[headerName];
        if (columnIndex) {
            rowArray[columnIndex - 1] = valuesByHeader[headerName];
        }
    });

    sheet.appendRow(rowArray);
}

function parseRequestData(e) {
    const parameterData = e && e.parameter ? e.parameter : {};
    const merged = {};

    Object.keys(parameterData).forEach((key) => {
        const value = parameterData[key];
        merged[key] = Array.isArray(value) ? value.join(',') : String(value || '');
    });

    return merged;
}

function getOrCreateFallbackSheet(spreadsheet) {
    return getOrCreateSheetWithHeaders(spreadsheet, FALLBACK_SHEET_NAME, FALLBACK_SHEET_HEADERS);
}

function getOrCreateIntegratedSheet(spreadsheet) {
    return getOrCreateSheetWithHeaders(
        spreadsheet,
        INTEGRATED_SHEET_NAME,
        INTEGRATED_SHEET_HEADERS,
    );
}

// 같은 연락처로 이 기간(일) 안에 신청한 기록이 있으면 재신청을 막는다
// const DUPLICATE_BLOCK_DAYS = 7;

// 통합 시트에서 같은 연락처의 가장 최근 신청시간을 찾는다. 없으면 null.
// sheet/indexByName은 호출부(doPost)에서 이미 읽어온 것을 그대로 받는다 (시트 재조회·헤더 재조회 방지)
/*
function findMostRecentApplicationDate(sheet, indexByName, phone) {
    const lastRow = sheet.getLastRow();

    if (lastRow < 2) {
        return null;
    }

    const phoneColumnIndex = indexByName['연락처'];
    const timestampColumnIndex = indexByName['신청시간'];

    if (!phoneColumnIndex || !timestampColumnIndex) {
        return null;
    }

    // 매칭된 셀마다 getValue()를 개별 호출하면 Apps Script 서비스 호출이 그만큼 늘어나 느려지므로,
    // 데이터 범위를 getValues() 한 번으로 통째로 읽어 메모리에서 비교한다
    const columnCount = Math.max(...Object.values(indexByName));
    const values = sheet.getRange(2, 1, lastRow - 1, columnCount).getValues();

    let latest = null;
    values.forEach((row) => {
        if (row[phoneColumnIndex - 1] !== phone) {
            return;
        }

        const timestamp = row[timestampColumnIndex - 1];
        if (timestamp instanceof Date && (!latest || timestamp > latest)) {
            latest = timestamp;
        }
    });

    return latest;
}
*/

// 정상 저장 경로가 실패했을 때 최후의 수단으로 호출. 이 함수마저 실패하면 콘솔 로그만 남기고 넘어간다.
function logToFallbackSheet(spreadsheet, name, phone, selectedType, reason) {
    try {
        const fallbackSheet = getOrCreateFallbackSheet(spreadsheet);
        const indexByName = getHeaderColumnIndexes(fallbackSheet);
        const lastRowBeforeAppend = fallbackSheet.getLastRow();
        const number = lastRowBeforeAppend;

        appendRowByHeader(
            fallbackSheet,
            {
                번호: number,
                신청시간: new Date(),
                이름: name,
                연락처: phone,
                상담유형: selectedType,
                유실사유: reason,
            },
            indexByName,
        );
    } catch (fallbackError) {
        console.error('fallback_log_error', fallbackError);
    }
}

// 클라이언트가 대시 없이 보내거나(외부 호출, 자동완성 등) 형식이 어긋나도, 시트에는 항상 하이픈이 들어간 형태로 저장되도록 서버에서 다시 한번 포맷한다
function formatPhoneForSheet(rawPhone) {
    const digits = String(rawPhone || '').replace(/[^0-9]/g, '');

    if (!digits) {
        return '';
    }

    // 서울(02)은 국번이 3자리(총 9자리, 02-XXX-XXXX)인 경우와 4자리(총 10자리, 02-XXXX-XXXX)인 경우가 둘 다 있다
    if (digits.startsWith('02')) {
        const middleLength = digits.length >= 10 ? 4 : 3;

        if (digits.length <= 2) {
            return digits;
        }

        if (digits.length <= 2 + middleLength) {
            return '02-' + digits.slice(2);
        }

        return '02-' + digits.slice(2, 2 + middleLength) + '-' + digits.slice(2 + middleLength);
    }

    const prefixLength = 3;

    if (digits.length <= prefixLength) {
        return digits;
    }

    // 휴대폰(010)은 항상 4자리+4자리(총 11자리)
    if (digits.startsWith('010')) {
        if (digits.length <= prefixLength + 4) {
            return digits.slice(0, prefixLength) + '-' + digits.slice(prefixLength);
        }

        return (
            digits.slice(0, prefixLength) +
            '-' +
            digits.slice(prefixLength, prefixLength + 4) +
            '-' +
            digits.slice(prefixLength + 4)
        );
    }

    // 그 외 지역번호(031~064)는 국번이 3자리(총 10자리, XXX-XXX-XXXX)인 경우와 4자리(총 11자리, XXX-XXXX-XXXX)인 경우가 둘 다 있다
    const middleLength = digits.length >= prefixLength + 8 ? 4 : 3;

    if (digits.length <= prefixLength + middleLength) {
        return digits.slice(0, prefixLength) + '-' + digits.slice(prefixLength);
    }

    return (
        digits.slice(0, prefixLength) +
        '-' +
        digits.slice(prefixLength, prefixLength + middleLength) +
        '-' +
        digits.slice(prefixLength + middleLength)
    );
}

function doPost(e) {
    const data = parseRequestData(e);
    const name = String(data.name || '').trim();
    const phone = formatPhoneForSheet(data.phone);
    const selectedType = String(data.selectedType || '').trim() || '1개~2개 임플란트';
    const clientIp = String(data.ip || '').trim();
    // 임시 테스트 신호: 프론트엔드 테스트 버튼이 켜면 실제 상담유형은 그대로 두고 저장만 강제로 실패시킨다. 테스트 끝나면 이 필드 관련 코드 전부 삭제할 것
    const forceFail = String(data.forceFail || '') === '1';

    // 같은 IP는 RATE_LIMIT_SECONDS 이내 재신청 차단 (클라이언트가 보낸 IP라 완전한 서버 검증은 아니고 연타 방지 목적)
    if (clientIp) {
        const rateLimitCache = CacheService.getScriptCache();
        const rateLimitKey = 'submit_ip_' + clientIp;

        if (rateLimitCache.get(rateLimitKey)) {
            return ContentService.createTextOutput('rate_limited');
        }

        rateLimitCache.put(rateLimitKey, '1', RATE_LIMIT_SECONDS);
    }

    const lock = LockService.getScriptLock();
    const lockAcquired = lock.tryLock(30000);

    if (!lockAcquired) {
        // 락을 못 잡아 정상 저장 경로를 탈 수 없는 경우에도 신청 데이터 자체는 잃지 않도록 백업
        if (name && phone) {
            try {
                const spreadsheet = SpreadsheetApp.openById(SPREADSHEET_ID);
                logToFallbackSheet(spreadsheet, name, phone, selectedType, 'lock_failed');
            } catch (openError) {
                console.error('lock_failed_fallback_error', openError);
            }
        }
        return ContentService.createTextOutput('lock_failed');
    }

    try {
        if (!name || !phone) {
            console.log(
                'missing_fields',
                JSON.stringify({
                    parameter: data,
                    postData: e && e.postData ? e.postData.contents : '',
                }),
            );
            return ContentService.createTextOutput('missing_fields');
        }

        const spreadsheet = SpreadsheetApp.openById(SPREADSHEET_ID);
        // 시트/헤더를 여기서 한 번만 읽어서, 중복확인(findMostRecentApplicationDate)과
        // 실제 저장(appendRowByHeader)이 같은 값을 재사용하도록 한다 (왕복 호출 절반 이하로 축소)
        const integratedSheet = getOrCreateIntegratedSheet(spreadsheet);
        const indexByName = getHeaderColumnIndexes(integratedSheet);

        // const lastApplicationDate = findMostRecentApplicationDate(integratedSheet, indexByName, phone);
        // if (lastApplicationDate) {
        //     const daysSinceLastApplication =
        //         (Date.now() - lastApplicationDate.getTime()) / (1000 * 60 * 60 * 24);
        //     if (daysSinceLastApplication < DUPLICATE_BLOCK_DAYS) {
        //         return ContentService.createTextOutput('already_applied');
        //     }
        // }

        if (forceFail) {
            // 실제 선택한 상담유형(selectedType)은 그대로 두고 정상 저장만 건너뛰어 유실 상황을 재현한다
            logToFallbackSheet(spreadsheet, name, phone, selectedType, 'test_forced_failure');
            return ContentService.createTextOutput('test_forced_failure');
        }

        const now = new Date();
        const lastRowBeforeAppend = integratedSheet.getLastRow();
        const integratedNumber = lastRowBeforeAppend;
        appendRowByHeader(
            integratedSheet,
            {
                번호: integratedNumber,
                신청시간: now,
                이름: name,
                연락처: phone,
                상담유형: selectedType,
            },
            indexByName,
        );

        return ContentService.createTextOutput('success');
    } catch (error) {
        console.error('submit_error', error);
        // 예상치 못한 에러로 정상 저장이 실패해도 신청 데이터는 DB로스 시트에 남긴다
        if (name && phone) {
            try {
                const spreadsheet = SpreadsheetApp.openById(SPREADSHEET_ID);
                logToFallbackSheet(
                    spreadsheet,
                    name,
                    phone,
                    selectedType,
                    'error: ' + error.message,
                );
            } catch (openError) {
                console.error('fallback_open_error', openError);
            }
        }
        return ContentService.createTextOutput('error');
    } finally {
        if (lockAcquired) {
            lock.releaseLock();
        }
    }
}

function doGet() {
    const cache = CacheService.getScriptCache();
    const cached = cache.get(RECENT_APPLICANTS_CACHE_KEY);

    if (cached) {
        return ContentService.createTextOutput(cached).setMimeType(ContentService.MimeType.JSON);
    }

    const spreadsheet = SpreadsheetApp.openById(SPREADSHEET_ID);
    const sheet = getOrCreateIntegratedSheet(spreadsheet);
    const maxItems = 20;
    const indexByName = getHeaderColumnIndexes(sheet);
    const timestampCol = indexByName['신청시간'] - 1;
    const nameCol = indexByName['이름'] - 1;
    const phoneCol = indexByName['연락처'] - 1;
    const typeCol = indexByName['상담유형'] - 1;

    let items = [];

    const lastRow = sheet.getLastRow();
    if (lastRow >= 2) {
        const numRows = Math.min(lastRow - 1, maxItems);
        const startRow = lastRow - numRows + 1;
        const values = sheet.getRange(startRow, 1, numRows, sheet.getLastColumn()).getValues();

        values.forEach((row) => {
            items.push({
                timestamp:
                    row[timestampCol] instanceof Date
                        ? row[timestampCol].toISOString()
                        : String(row[timestampCol] || ''),
                name: String(row[nameCol] || ''),
                phone: String(row[phoneCol] || ''),
                type: String(row[typeCol] || ''),
            });
        });
    }

    items.sort((a, b) => new Date(b.timestamp).getTime() - new Date(a.timestamp).getTime());
    items = items.slice(0, 20);

    const payload = JSON.stringify({ items: items });
    cache.put(RECENT_APPLICANTS_CACHE_KEY, payload, RECENT_APPLICANTS_CACHE_TTL_SECONDS);

    return ContentService.createTextOutput(payload).setMimeType(ContentService.MimeType.JSON);
}
