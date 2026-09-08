const form = document.querySelector('#consult-form');
const submitButton = form ? form.querySelector('button[type="submit"]') : null;
const selectedTypeInput = document.querySelector('#selected-type');
const choiceSelectBtn = document.querySelector('#choice-select-btn');
const choiceSelectValue = document.querySelector('#choice-select-value');
const choiceOptionsList = document.querySelector('#choice-options');
const choiceOptionEls = choiceOptionsList
    ? Array.from(choiceOptionsList.querySelectorAll('.choice-option'))
    : [];
const DEFAULT_CHOICE_VALUE = '1개~2개 임플란트';
const eventRemainingCountEl = document.querySelector('#event-remaining-count');
const consultationList = document.querySelector('#consultation-list');
const consultationListEmpty = document.querySelector('#consultation-list-empty');
const API_URL = form ? form.getAttribute('action') : '';
const phoneInput = document.querySelector('input[name="phone"]');
const nameInput = document.querySelector('input[name="name"]');
const countdownTimerEl = document.querySelector('#countdown-timer');
const clientIpInput = document.querySelector('#client-ip');

// 서버에서 같은 IP의 5분 이내 재신청을 막을 수 있도록 공인 IP를 미리 조회해둔다
if (clientIpInput) {
    fetch('https://api.ipify.org?format=json')
        .then((response) => response.json())
        .then((data) => {
            clientIpInput.value = data.ip || '';
        })
        .catch(() => {
            // 조회 실패 시 빈 값으로 두면 서버는 해당 신청에 IP 제한을 적용하지 않는다
        });
}

// ==== 이름 인풋 금지 단어 목록 (여기에 단어를 추가/삭제하세요) ====
// 짧고 애매한 글자(정상 이름에도 들어갈 수 있는 글자)는 이름 전체와 정확히 같을 때만 차단
const FORBIDDEN_NAME_EXACT_WORDS = [
    '개',
    '돌',
    '좆',
    '좃',
    '샹',
];

// 명확한 욕설/조합 단어는 이름에 포함되어 있으면 차단
const FORBIDDEN_NAME_WORDS = [
    '시발',
    '씨발',
    'ㅅㅂ',
    'ㅂㅅ',
    'ㅄ',
    '병신',
    '시브랄',
    '살인',
    '살인자',
    '니금마',
    '뒤져',
    '돌팔이',
    '돌아이',
    '미친',
    '미친놈',
    '미친년',
    '개새',
    '개새끼',
    '사기',
    '사기꾼',
    '돌팔',
    '썅놈',
    '싸가지',
    '좆까',
    '좃까',
];

function containsForbiddenWord(value) {
    const normalized = String(value || '').trim().toLowerCase();
    const isExactMatch = FORBIDDEN_NAME_EXACT_WORDS.some((word) => word && normalized === word.toLowerCase());
    const isSubstringMatch = FORBIDDEN_NAME_WORDS.some((word) => word && normalized.includes(word.toLowerCase()));
    return isExactMatch || isSubstringMatch;
}

// 매주 일요일 23:59:59 마감, 월요일 자동 재시작
function getWeeklyDeadline() {
    const now = new Date();
    const day = now.getDay(); // 0=일, 1=월 ... 6=토
    const daysUntilSunday = day === 0 ? 0 : 7 - day;
    const deadline = new Date(now);
    deadline.setDate(now.getDate() + daysUntilSunday);
    deadline.setHours(23, 59, 59, 0);
    return deadline;
}

function updateCountdown() {
    if (!countdownTimerEl) {
        return;
    }

    const diff = getWeeklyDeadline().getTime() - Date.now();

    if (diff <= 0) {
        countdownTimerEl.textContent = '00:00:00';
        return;
    }

    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((diff % (1000 * 60)) / 1000);

    const pad = (n) => String(n).padStart(2, '0');
    const dayText = days > 0 ? `${days}일 ` : '';
    countdownTimerEl.textContent = `${dayText}${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
}

if (countdownTimerEl) {
    updateCountdown();
    setInterval(updateCountdown, 1000);
}

// 남은 이벤트 수량: 78개에서 40개까지 줄어들었다가 다시 78개로 돌아가 반복
const EVENT_REMAINING_START = 78;
const EVENT_REMAINING_END = 40;
const EVENT_REMAINING_INTERVAL_MS = 4500;

function startEventRemainingCountdown() {
    if (!eventRemainingCountEl) {
        return;
    }

    let current = EVENT_REMAINING_START;
    eventRemainingCountEl.textContent = current;

    setInterval(() => {
        current -= 1;
        if (current < EVENT_REMAINING_END) {
            current = EVENT_REMAINING_START;
        }
        eventRemainingCountEl.textContent = current;
    }, EVENT_REMAINING_INTERVAL_MS);
}

startEventRemainingCountdown();

// event-remaining 배지 가로 길이를 choice-heading 배지와 동일하게 맞춘다 (텍스트 길이가 서로 달라 CSS만으론 맞출 수 없음)
function syncEventRemainingWidth() {
    const heading = document.querySelector('.choice-heading');
    const badge = document.querySelector('.event-remaining');

    if (!heading || !badge) {
        return;
    }

    badge.style.width = `${heading.getBoundingClientRect().width}px`;
}

syncEventRemainingWidth();
window.addEventListener('resize', syncEventRemainingWidth);

if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(syncEventRemainingWidth);
}

// 허용하는 지역번호/통신사 번호 (앞 2~3자리)
const ALLOWED_PHONE_PREFIXES = [
    '02',
    '031', '032', '033',
    '041', '042', '043', '044',
    '051', '052', '054', '055',
    '061', '062', '063', '064',
    '010',
];

function isAllowedPhonePrefix(prefixDigits) {
    return ALLOWED_PHONE_PREFIXES.some(
        (code) => code.startsWith(prefixDigits) || prefixDigits.startsWith(code),
    );
}

function formatPhoneInput(value) {
    const rawDigits = value.replace(/[^0-9]/g, '').slice(0, 11);
    let digits = '';

    for (const digit of rawDigits) {
        if (digits.length < 3 && !isAllowedPhonePrefix(digits + digit)) {
            break;
        }
        digits += digit;
    }

    // 서울(02)은 국번이 3자리(총 9자리, 02-XXX-XXXX)인 경우와 4자리(총 10자리, 02-XXXX-XXXX)인 경우가 둘 다 있다
    if (digits.startsWith('02')) {
        digits = digits.slice(0, 10);

        if (digits.length <= 2) {
            return digits;
        }

        const middleLength = digits.length >= 10 ? 4 : 3;

        if (digits.length <= 2 + middleLength) {
            return `02-${digits.slice(2)}`;
        }

        return `02-${digits.slice(2, 2 + middleLength)}-${digits.slice(2 + middleLength)}`;
    }

    const prefixLength = 3;

    if (digits.length <= prefixLength) {
        return digits;
    }

    // 휴대폰(010)은 항상 4자리+4자리(총 11자리)
    if (digits.startsWith('010')) {
        if (digits.length <= prefixLength + 4) {
            return `${digits.slice(0, prefixLength)}-${digits.slice(prefixLength)}`;
        }

        return `${digits.slice(0, prefixLength)}-${digits.slice(prefixLength, prefixLength + 4)}-${digits.slice(prefixLength + 4)}`;
    }

    // 그 외 지역번호(031~064)는 국번이 3자리(총 10자리, XXX-XXX-XXXX)인 경우와 4자리(총 11자리, XXX-XXXX-XXXX)인 경우가 둘 다 있다
    const middleLength = digits.length >= prefixLength + 8 ? 4 : 3;

    if (digits.length <= prefixLength + middleLength) {
        return `${digits.slice(0, prefixLength)}-${digits.slice(prefixLength)}`;
    }

    return `${digits.slice(0, prefixLength)}-${digits.slice(prefixLength, prefixLength + middleLength)}-${digits.slice(prefixLength + middleLength)}`;
}

if (phoneInput) {
    phoneInput.addEventListener('input', () => {
        phoneInput.value = formatPhoneInput(phoneInput.value);
    });
}

if (nameInput) {
    nameInput.addEventListener('input', () => {
        nameInput.value = nameInput.value.replace(/[0-9]/g, '');
    });
}

const agreeDetailToggle = document.querySelector('#agree-detail-toggle');
const agreeDetailPanel = document.querySelector('#agree-detail-panel');

if (agreeDetailToggle && agreeDetailPanel) {
    agreeDetailToggle.addEventListener('click', () => {
        const isExpanded = agreeDetailToggle.getAttribute('aria-expanded') === 'true';
        agreeDetailToggle.setAttribute('aria-expanded', String(!isExpanded));
        agreeDetailPanel.hidden = isExpanded;
    });
}

const footerDetailToggle = document.querySelector('#footer-detail-toggle');
const footerDetailText = document.querySelector('#footer-detail-text');

if (footerDetailToggle && footerDetailText) {
    footerDetailToggle.addEventListener('click', () => {
        const isExpanded = footerDetailToggle.getAttribute('aria-expanded') === 'true';
        footerDetailToggle.setAttribute('aria-expanded', String(!isExpanded));
        footerDetailText.hidden = isExpanded;
    });
}

function normalizePhone(value) {
    return value.replace(/[^0-9]/g, '');
}

// 자릿수가 끝까지 안 채워진 번호(예: 010-1234-56) 차단
function isCompletePhoneNumber(phone) {
    if (phone.startsWith('02')) {
        return phone.length === 9 || phone.length === 10;
    }

    if (phone.startsWith('010')) {
        return phone.length === 11;
    }

    return phone.length === 10 || phone.length === 11;
}

// 장난번호(예: 010-4444-4444, 010-1234-5678) 차단
function isSuspiciousPhoneNumber(phone) {
    if (phone.length < 8) {
        return false;
    }

    const last8 = phone.slice(-8);
    const firstHalf = last8.slice(0, 4);
    const secondHalf = last8.slice(4);

    // 뒤 4자리가 그대로 반복되는 패턴 (4444-4444, 1234-1234 등)
    if (firstHalf === secondHalf) {
        return true;
    }

    // 순차 증가/감소 패턴 (1234-5678, 8765-4321 등)
    const SEQUENTIAL_PATTERNS = [
        '01234567', '12345678', '23456789',
        '98765432', '87654321', '76543210',
    ];

    return SEQUENTIAL_PATTERNS.includes(last8);
}

function setChoiceValue(value) {
    if (choiceSelectValue) {
        choiceSelectValue.textContent = value;
    }

    choiceOptionEls.forEach((option) => {
        const isSelected = option.dataset.value === value;
        option.classList.toggle('is-selected', isSelected);
        option.setAttribute('aria-selected', String(isSelected));
    });

    if (selectedTypeInput) {
        selectedTypeInput.value = value;
    }
}

function openChoiceOptions() {
    if (!choiceOptionsList || !choiceSelectBtn) {
        return;
    }

    choiceOptionsList.hidden = false;
    choiceSelectBtn.setAttribute('aria-expanded', 'true');
    choiceSelectBtn.classList.add('is-open');
}

function closeChoiceOptions() {
    if (!choiceOptionsList || !choiceSelectBtn) {
        return;
    }

    choiceOptionsList.hidden = true;
    choiceSelectBtn.setAttribute('aria-expanded', 'false');
    choiceSelectBtn.classList.remove('is-open');
}

if (choiceSelectBtn && choiceOptionsList) {
    choiceSelectBtn.addEventListener('click', () => {
        const isOpen = choiceSelectBtn.getAttribute('aria-expanded') === 'true';
        if (isOpen) {
            closeChoiceOptions();
        } else {
            openChoiceOptions();
        }
    });

    choiceOptionEls.forEach((option) => {
        option.addEventListener('click', () => {
            setChoiceValue(option.dataset.value);
            closeChoiceOptions();
        });
    });

    document.addEventListener('click', (event) => {
        if (!choiceSelectBtn.contains(event.target) && !choiceOptionsList.contains(event.target)) {
            closeChoiceOptions();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeChoiceOptions();
        }
    });
}

function maskName(value) {
    const name = String(value || '').trim();

    if (name.length <= 1) {
        return name;
    }

    if (name.length === 2) {
        return `${name[0]}*`;
    }

    return `${name[0]}${'*'.repeat(name.length - 2)}${name[name.length - 1]}`;
}

function maskPhone(value) {
    const digits = String(value || '').replace(/[^0-9]/g, '');

    if (digits.length < 8) {
        return digits;
    }

    return `${digits.slice(0, 3)}-${digits.slice(3, 4)}***-****`;
}

function formatTimestamp(value) {
    const date = new Date(value);

    if (Number.isNaN(date.getTime())) {
        return String(value || '');
    }

    const pad = (n) => String(n).padStart(2, '0');
    return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}`;
}

function buildApplicantRow(item) {
    const row = document.createElement('div');
    row.className = 'recent-applicants-row';

    const dateCell = document.createElement('div');
    dateCell.textContent = formatTimestamp(item.timestamp);

    const nameCell = document.createElement('div');
    nameCell.textContent = maskName(item.name);

    const phoneCell = document.createElement('div');
    phoneCell.textContent = maskPhone(item.phone);

    row.append(dateCell, nameCell, phoneCell);
    return row;
}

let rollTimer = null;

function startApplicantRoll(items) {
    if (rollTimer) {
        clearInterval(rollTimer);
        rollTimer = null;
    }

    if (!consultationList) {
        return;
    }

    consultationList.innerHTML = '';
    consultationList.classList.remove('is-rolling');
    consultationList.style.transform = 'translateY(0)';

    if (consultationListEmpty) {
        consultationListEmpty.hidden = items.length > 0;
    }

    if (items.length === 0) {
        return;
    }

    let index = 0;
    const nextItem = () => {
        const item = items[index % items.length];
        index += 1;
        return item;
    };

    // 화면에 보이는 4줄 + 여유분
    for (let i = 0; i < 6; i += 1) {
        consultationList.appendChild(buildApplicantRow(nextItem()));
    }

    if (items.length <= 1) {
        return;
    }

    let paused = false;
    const viewportEl = consultationList.parentElement;

    if (viewportEl) {
        viewportEl.addEventListener('mouseenter', () => {
            paused = true;
        });
        viewportEl.addEventListener('mouseleave', () => {
            paused = false;
        });
    }

    let rolling = false;

    rollTimer = setInterval(() => {
        if (rolling || paused) {
            return;
        }

        const firstRow = consultationList.firstElementChild;
        const rowHeight = firstRow ? firstRow.getBoundingClientRect().height : 0;

        if (!rowHeight) {
            return;
        }

        rolling = true;
        consultationList.appendChild(buildApplicantRow(nextItem()));
        consultationList.classList.add('is-rolling');
        void consultationList.offsetHeight; // 강제 리플로우: 트랜지션이 확실히 새 transform 값을 감지하게 함
        consultationList.style.transform = `translateY(-${rowHeight}px)`;

        setTimeout(() => {
            if (consultationList.firstElementChild) {
                consultationList.firstElementChild.remove();
            }

            consultationList.classList.remove('is-rolling');
            consultationList.style.transform = 'translateY(0)';
            rolling = false;
        }, 500);
    }, 1500);
}

// 실시간 신청 현황은 실제 시트 데이터가 아니라 가상의 신청자 목록을 코드로 생성해서 보여준다.
const FAKE_APPLICANT_COUNT = 30;
const FAKE_APPLICANT_SURNAMES = ['김', '이', '박', '최', '정', '강', '조', '윤', '장', '임'];
const FAKE_APPLICANT_GIVEN_NAMES = [
    '민준', '서연', '도윤', '하은', '시우', '지우', '예준', '수아', '주원', '다은',
    '지호', '서준', '유진', '현우', '소율', '민서', '우진', '채원', '준서', '아린',
];

function randomItem(list) {
    return list[Math.floor(Math.random() * list.length)];
}

function generateFakePhoneDigits() {
    let digits = '010';
    for (let i = 0; i < 8; i += 1) {
        digits += String(Math.floor(Math.random() * 10));
    }
    return digits;
}

function generateFakeApplicants(count) {
    const todayTimestamp = new Date().toISOString();
    const items = [];

    for (let i = 0; i < count; i += 1) {
        items.push({
            timestamp: todayTimestamp,
            name: randomItem(FAKE_APPLICANT_SURNAMES) + randomItem(FAKE_APPLICANT_GIVEN_NAMES),
            phone: generateFakePhoneDigits(),
        });
    }

    return items;
}

function loadConsultationList() {
    if (!consultationList) {
        return;
    }

    startApplicantRoll(generateFakeApplicants(FAKE_APPLICANT_COUNT));
}

const appModal = document.querySelector('#app-modal');
const appModalIcon = document.querySelector('#app-modal-icon');
const appModalTitle = document.querySelector('#app-modal-title');
const appModalMessage = document.querySelector('#app-modal-message');
const appModalConfirm = document.querySelector('#app-modal-confirm');

function showModal({ icon, title, message, tone = 'default' }) {
    if (!appModal) {
        return;
    }

    if (appModalIcon) {
        appModalIcon.textContent = icon;
        appModalIcon.classList.toggle('modal-icon--warning', tone === 'warning');
    }

    if (appModalTitle) {
        appModalTitle.textContent = title;
    }

    if (appModalMessage) {
        appModalMessage.textContent = message;
    }

    appModal.hidden = false;
}

function hideModal() {
    if (!appModal) {
        return;
    }

    appModal.hidden = true;
}

if (appModalConfirm) {
    appModalConfirm.addEventListener('click', hideModal);
}

if (appModal) {
    appModal.addEventListener('click', (event) => {
        if (event.target === appModal) {
            hideModal();
        }
    });
}

let waitingForResponse = false;

async function submitConsultForm(event) {
    event.preventDefault();

    if (waitingForResponse) {
        return;
    }

    const formData = new FormData(form);
    const name = String(formData.get('name') || '').trim();
    const phoneDisplay = String(formData.get('phone') || '').trim();
    const phone = normalizePhone(phoneDisplay);
    const agree = formData.get('agree') === 'on';
    const selectedType = String((selectedTypeInput && selectedTypeInput.value) || '').trim() || '1개~2개 임플란트';

    if (!name || !phone) {
        showModal({
            icon: '⚠️',
            title: '입력값을 확인해주세요',
            message: '이름과 연락처를 입력해주세요.',
            tone: 'warning',
        });
        return;
    }

    if (!isCompletePhoneNumber(phone) || isSuspiciousPhoneNumber(phone)) {
        showModal({
            icon: '⚠️',
            title: '연락처를 확인해주세요',
            message: '올바른 연락처를 입력해주세요.',
            tone: 'warning',
        });
        return;
    }

    if (containsForbiddenWord(name)) {
        showModal({
            icon: '⚠️',
            title: '이름을 확인해주세요',
            message: '이름에 사용할 수 없는 단어가 포함되어 있습니다.',
            tone: 'warning',
        });
        return;
    }

    if (!agree) {
        showModal({
            icon: '⚠️',
            title: '약관 동의가 필요해요',
            message: '개인정보 수집 및 이용에 동의해주세요.',
            tone: 'warning',
        });
        return;
    }

    waitingForResponse = true;
    if (submitButton) {
        submitButton.disabled = true;
        submitButton.textContent = '전송 중...';
    }

    try {
        await fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'text/plain;charset=utf-8' }, // GAS CORS 우회용 (실제 내용은 JSON)
            body: JSON.stringify({
                '탭': '55HID3',            // 고정 탭: 기존에 만들어둔 "55HID3" 탭에 저장
                '이름': name,
                '연락처': phoneDisplay,
                '시술종류': selectedType,   // 선택한 항목을 시술종류로도 재사용
                '시술시기': '',             // 폼에서 안 받는 값이라 빈 값
            }),
        });
    } catch (error) {
        console.error('submit_consult_form_error', error);
    }

    waitingForResponse = false;
    if (submitButton) {
        submitButton.disabled = false;
        submitButton.textContent = '맞춤 견적 알아보기';
    }

    // 서버가 result:'error'를 줘도 사용자에게는 완료 메시지를 유지한다 (재시도 유도보다 이탈 방지 우선)
    form.reset();
    setChoiceValue(DEFAULT_CHOICE_VALUE);
    loadConsultationList();

    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({ event: 'form_submit_success' });

    showModal({
        icon: '✅',
        title: '맞춤 견적 알아보기 신청이 완료되었습니다.',
        message: '빠른 시간 안에 상담원이 연락드리겠습니다.',
    });
}

setChoiceValue(DEFAULT_CHOICE_VALUE);
loadConsultationList();

if (form) {
    form.addEventListener('submit', submitConsultForm);
}

// 임시 테스트 코드: DB로스 유실 테스트용. 테스트 끝나면 이 블록과 counsel.html의 #debug-force-fail-btn, #force-fail-flag 삭제할 것
const debugForceFailBtn = document.querySelector('#debug-force-fail-btn');
const forceFailFlagInput = document.querySelector('#force-fail-flag');

if (debugForceFailBtn && new URLSearchParams(window.location.search).get('test') === '1') {
    debugForceFailBtn.style.display = 'inline-flex';

    debugForceFailBtn.addEventListener('click', () => {
        // 실제 선택한 상담유형(selectedType)은 건드리지 않고, 저장만 강제로 실패시키는 신호만 켠다
        if (forceFailFlagInput) {
            forceFailFlagInput.value = '1';
        }

        debugForceFailBtn.textContent = '✅ 실패 강제 적용됨 (이제 신청하기 누르세요)';
    });
}