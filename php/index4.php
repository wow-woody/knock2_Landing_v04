<!DOCTYPE html>
<html lang="ko">

<head>
    <!-- Google Tag Manager: GTM-XXXXXXX는 실제 발급받은 컨테이너 ID로 교체 필요 -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            }); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-XXXXXXX');</script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" as="style" crossorigin
        href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.css">
    <style>
        /* ==== css/reset.css ==== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        ol,
        ul,
        li {
            list-style: none;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            vertical-align: top;
            max-width: 100%;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        /* ==== css/index4.css ==== */
        :root {
            --bg: #fff8ec;
            --ink: #3a2418;
            --sub: #9c7a5c;
            --orange-card: #fff3de;
            --orange-line: rgba(226, 98, 47, 0.18);
            --gold: #e2622f;
            --gold-soft: #f2a24c;
            --gold-deep: #b8391f;
            --brown-deep: #5c2a15;
            --white: #ffffff;
            --dark-ink: #2a1a10;
            --card: #fffdf8;
            --red: #d9432b;
        }

        body {
            font-family: 'Pretendard', 'Apple SD Gothic Neo', 'Malgun Gothic', sans-serif;
            max-width: 480px;
            margin: 0 auto;
            color: var(--ink);
            padding: 12px;
            letter-spacing: -0.05em;
            word-break: keep-all;
        }

        /* ---- 상단 이미지 ---- */
        .consult-hero-img {
            margin-bottom: 12px;
        }

        .consult-hero-img p {
            margin: 0;
            overflow: hidden;
            border: 2px solid var(--orange-line);
            border-radius: 24px;
            box-shadow:
                0 10px 24px rgba(226, 98, 47, 0.08),
                0 2px 6px rgba(226, 98, 47, 0.05);
        }

        .consult-hero-img img {
            display: block;
            width: 100%;
            height: auto;
            /* im-20_02.gif 원본 크기(1000x750, 4:3)에 맞춘 비율 */
            aspect-ratio: 1000 / 750;
            object-fit: cover;
            object-position: top;
        }

        /* ---- 안내 배너 ---- */
        .page-title {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            box-sizing: border-box;
            margin: 2px 0 16px;
            background: var(--orange-card);
            border: 2px solid var(--orange-line);
            border-radius: 14px;
            padding: 14px 16px;
            font-size: clamp(17px, 5vw, 20px);
            font-weight: 600;
            color: var(--sub);
            line-height: 1.4;
        }

        .page-title em {
            color: var(--gold);
            font-style: normal;
            font-weight: 800;
        }

        /* ---- 가격 카드 ---- */
        .price-card {
            position: relative;
            border-radius: 24px;
            margin-bottom: 18px;
            background: var(--orange-card);
            border: 2px solid var(--orange-line);
            box-shadow:
                0 10px 24px rgba(226, 98, 47,0.08),
                0 2px 6px rgba(226, 98, 47,0.05);
            overflow: hidden;
            text-align: center;
        }

        .price-card-top {
            background: linear-gradient(160deg, #fff3de 0%, #ffe3ba 100%);
            padding: 28px 4px 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 32px;
        }

        .price-card-left {
            flex: 0 1 auto;
            min-width: 0;
            text-align: left;
        }

        .price-card-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            max-width: 100%;
            box-sizing: border-box;
            background: rgba(226, 98, 47,0.1);
            color: var(--gold);
            font-weight: 700;
            font-size: clamp(13px, 3.8vw, 22px);
            padding: 7px 14px;
            border-radius: 99px;
            border: 1.5px solid rgba(226, 98, 47,0.35);
            margin-bottom: 12px;
            white-space: nowrap;
        }

        .price-card-amount-row {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 3px;
            flex-wrap: wrap;
            width: 100%;
        }

        .price-card-amount-meta {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 3px;
            padding-bottom: 6px;
        }

        .price-card-per {
            display: inline-block;
            box-sizing: border-box;
            text-align: center;
            margin-left: 2px;
            background: rgba(226, 98, 47,0.08);
            color: var(--ink);
            font-weight: 700;
            font-size: clamp(12px, 3vw, 19px);
            padding: 4px 9px;
            border-radius: 99px;
            white-space: nowrap;
        }

        .price-card-image {
            flex: 0 0 auto;
            width: clamp(80px, 28%, 132px);
            aspect-ratio: 2.48/3.5;
            background: rgba(226, 98, 47,0.05);
            border: 1.5px solid rgba(226, 98, 47,0.28);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            overflow: hidden;
        }

        .price-card-image img {
            width: 90%;
            height: 90%;
            object-fit: contain;
        }

        .price-card-body {
            padding: 20px 20px 24px;
            border: 1px solid var(--orange-line);
            border-top: none;
            border-radius: 0 0 22px 22px;
        }

        .price-card-won {
            position: relative;
            display: inline-block;
            font-size: clamp(64px, 22vw, 92px);
            font-weight: 900;
            line-height: 1;
            background: linear-gradient(135deg, var(--gold-soft), var(--gold-deep));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: -3px;
        }

        .price-card-won::before {
            content: attr(data-text);
            position: absolute;
            inset: 0;
            background: linear-gradient(
                105deg,
                transparent 40%,
                rgba(255, 255, 255, 0.9) 50%,
                transparent 60%
            );
            background-size: 300% 100%;
            background-position: 150% 0;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: text-shine 7s ease-in-out infinite;
        }

        @keyframes text-shine {
            0% {
                background-position: 150% 0;
            }

            60%,
            100% {
                background-position: -150% 0;
            }
        }

        .price-card-unit {
            font-size: clamp(20px, 5.5vw, 30px);
            font-weight: 800;
            color: var(--ink);
            text-align: center;
            margin-left: 6px;
            white-space: nowrap;
        }

        .price-card-included-title {
            font-size: clamp(19px, 5.2vw, 22px);
            font-weight: 800;
            color: var(--ink);
            margin-bottom: 18px;
        }

        .price-card-included {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
            text-align: left;
        }

        .price-card-included li {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--card);
            border-radius: 14px;
            padding: 14px 16px;
            font-size: clamp(19px, 5.2vw, 22px);
            font-weight: 700;
            color: var(--dark-ink);
            line-height: 1.4;
            box-shadow: 0 2px 8px rgba(226, 98, 47,0.08);
        }

        .price-card-included input[type='checkbox'] {
            appearance: none;
            -webkit-appearance: none;
            flex: 0 0 auto;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold-soft), var(--gold-deep));
            position: relative;
            margin: 0;
            cursor: default;
        }

        .price-card-included input[type='checkbox']::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 46%;
            width: 10px;
            height: 6px;
            border-left: 2px solid #ffffff;
            border-bottom: 2px solid #ffffff;
            transform: translate(-50%, -50%) rotate(-45deg);
        }

        /* =========================================================
           상담 신청 폼
        ========================================================= */
        .countdown-wrap {
            display: flex;
            align-items: center;
            gap: 6px;
            width: fit-content;
            margin: 14px auto 10px;
            background: rgba(226, 98, 47,0.1);
            border: 1px solid rgba(226, 98, 47,0.3);
            color: var(--gold);
            font-size: 0.82rem;
            font-weight: 600;
            padding: 7px 16px;
            border-radius: 999px;
        }

        .countdown-timer {
            display: inline-block;
            min-width: 108px;
            font-size: 0.88rem;
            font-weight: 800;
            font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;
            color: var(--red);
            letter-spacing: 0.5px;
            font-variant-numeric: tabular-nums;
            text-align: left;
        }

        .item,
        .form-section {
            position: relative;
            display: grid;
            gap: 18px;
            width: 100%;
            padding: 24px;
            margin-bottom: 12px;
            border: 2px solid var(--orange-line);
            border-radius: 28px;
            background: #fffaea;
            box-shadow:
                0 10px 24px rgba(226, 98, 47,0.08),
                0 2px 6px rgba(226, 98, 47,0.05);
            box-sizing: border-box;
        }

        .item {
            /* margin-top: 4px; */
        }

        .item__top {
            display: grid;
            gap: 10px;
            text-align: center;
        }

        .eyebrow {
            display: inline-flex;
            width: fit-content;
            margin: 0;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(226, 98, 47,0.1);
            border: 1px solid rgba(226, 98, 47,0.3);
            color: var(--gold);
            font-size: 0.95rem;
            font-weight: 700;
        }

        .form-section .eyebrow {
            display: flex;
            align-items: center;
            gap: 6px;
            height: 33px;
            margin: 0 auto;
            background: rgba(226, 98, 47,0.1);
            border: 1px solid rgba(226, 98, 47,0.3);
            color: var(--gold);
            font-size: 0.82rem;
            font-weight: 600;
            padding: 0 16px;
            border-radius: 999px;
        }

        .choice-heading {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            width: fit-content;
            height: 33px;
            margin: 0 auto;
            background: rgba(226, 98, 47,0.1);
            border: 1px solid rgba(226, 98, 47,0.3);
            color: var(--gold);
            font-size: 0.82rem;
            font-weight: 600;
            line-height: 1;
            padding: 0 16px;
            border-radius: 999px;
        }

        .event-remaining {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: fit-content;
            height: 33px;
            margin: 0 auto;
            padding: 0 16px;
            border-radius: 999px;
            background: rgba(229, 72, 77, 0.08);
            border: 1px solid rgba(229, 72, 77, 0.3);
        }

        .event-remaining__dot {
            flex: none;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--red);
            animation: event-remaining-pulse 1.4s ease-in-out infinite;
        }

        @keyframes event-remaining-pulse {
            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.35;
                transform: scale(0.65);
            }
        }

        .event-remaining__text {
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 0.82rem;
            font-weight: 600;
            line-height: 1;
            color: var(--sub);
        }

        .event-remaining__count {
            color: var(--red);
            font-weight: 800;
            font-size: 0.82rem;
            font-variant-numeric: tabular-nums;
        }

        .event-remaining__unit {
            color: var(--red);
            font-weight: 800;
        }

        .choice-select-wrap {
            position: relative;
        }

        .choice-select {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            width: 100%;
            box-sizing: border-box;
            padding: 18px 20px;
            border: 3px solid rgba(15, 27, 45, 0.15);
            border-radius: 16px;
            background: var(--card);
            color: var(--dark-ink);
            font-family: inherit;
            font-size: 1.2rem;
            font-weight: 800;
            text-align: left;
            cursor: pointer;
            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .choice-select:hover {
            border-color: var(--gold);
        }

        .choice-select:focus-visible {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(226, 98, 47, 0.15);
        }

        .choice-select.is-open {
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(226, 98, 47, 0.15);
        }

        .choice-select__arrow {
            flex: none;
            width: 10px;
            height: 10px;
            border-right: 2.5px solid var(--gold);
            border-bottom: 2.5px solid var(--gold);
            transform: rotate(45deg);
            transition: transform 0.2s ease;
        }

        .choice-select.is-open .choice-select__arrow {
            transform: rotate(-135deg);
        }

        .choice-options {
            position: absolute;
            z-index: 20;
            top: calc(100% + 8px);
            left: 0;
            right: 0;
            margin: 0;
            padding: 8px;
            list-style: none;
            display: grid;
            gap: 4px;
            background: var(--card);
            border: 2px solid var(--orange-line);
            border-radius: 16px;
            box-shadow:
                0 16px 32px rgba(226, 98, 47, 0.18),
                0 4px 10px rgba(226, 98, 47, 0.08);
            animation: choice-options-pop 0.15s ease;
        }

        .choice-options[hidden] {
            display: none;
        }

        @keyframes choice-options-pop {
            from {
                opacity: 0;
                transform: translateY(-4px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .choice-option {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark-ink);
            cursor: pointer;
            transition:
                background 0.15s ease,
                color 0.15s ease;
        }

        .choice-option:hover {
            background: rgba(226, 98, 47, 0.08);
        }

        .choice-option.is-selected {
            background: rgba(226, 98, 47, 0.12);
            color: var(--gold-deep);
        }

        .choice-option.is-selected::after {
            content: '✓';
            color: var(--gold);
            font-weight: 800;
        }

        .consult-form {
            display: grid;
            gap: 16px;
        }

        .field {
            display: grid;
            gap: 8px;
        }

        .field span {
            font-size: 0.98rem;
            font-weight: 700;
            color: var(--ink);
        }

        .field input {
            width: 100%;
            min-height: 76px;
            padding: 0 20px;
            border: 3px solid rgba(15, 27, 45, 0.15);
            border-radius: 16px;
            background: var(--card);
            color: var(--dark-ink);
            font-size: 24px;
            outline: none;
            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .field input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(226, 98, 47,0.15);
        }

        .field input::placeholder {
            color: #b5bcc9;
        }

        .input-icon {
            position: relative;
        }

        .input-icon__svg {
            position: absolute;
            top: 50%;
            left: 16px;
            transform: translateY(-50%);
            width: 28px;
            height: 28px;
            fill: none;
            stroke: #b5bcc9;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            pointer-events: none;
        }

        .input-icon input {
            padding-left: 52px;
        }

        .agree-panel {
            background: rgba(226, 98, 47,0.04);
            border-radius: 12px;
            overflow: hidden;
        }

        .agree-panel__row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 14px 16px;
            cursor: pointer;
        }

        .agree-panel__row input {
            appearance: none;
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            margin-top: 2px;
            flex-shrink: 0;
            position: relative;
            border: 2px solid var(--orange-line);
            border-radius: 50%;
            background: transparent;
            cursor: pointer;
            transition:
                border-color 0.2s ease,
                background 0.2s ease;
        }

        .agree-panel__row input:checked {
            background: var(--gold);
            border-color: var(--gold);
        }

        .agree-panel__row input:checked::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 4px;
            height: 8px;
            border: solid #ffffff;
            border-width: 0 2px 2px 0;
            transform: translate(-50%, -60%) rotate(45deg);
        }

        .agree-panel__row span {
            font-size: 0.92rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--ink);
        }

        .agree-panel__row strong {
            font-weight: 800;
        }

        .agree-panel__toggle {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 16px;
            border: 0;
            border-top: 1px solid rgba(226, 98, 47,0.1);
            background: none;
            color: var(--sub);
            font-family: inherit;
            font-size: 0.78rem;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .agree-panel__toggle:hover {
            color: var(--ink);
        }

        .agree-panel__chevron {
            width: 14px;
            height: 14px;
            color: currentColor;
            transition: transform 0.2s ease;
        }

        .agree-panel__toggle[aria-expanded='true'] .agree-panel__chevron {
            transform: rotate(180deg);
        }

        .agree-panel__detail {
            padding: 12px 16px 14px;
            border-top: 1px solid rgba(226, 98, 47,0.1);
            background: rgba(226, 98, 47,0.03);
            color: var(--sub);
            font-size: 0.78rem;
        }

        .agree-panel__detail-title {
            margin: 0 0 8px;
            font-weight: 800;
            color: var(--ink);
        }

        .agree-panel__detail-block {
            margin-bottom: 8px;
        }

        .agree-panel__detail-block:last-child {
            margin-bottom: 0;
        }

        .agree-panel__detail-heading {
            margin: 0 0 2px;
            font-weight: 700;
            color: var(--ink);
            opacity: 0.85;
        }

        .agree-panel__detail-text {
            margin: 0 0 2px;
            padding-left: 8px;
        }

        .agree-panel__detail-text:last-child {
            margin-bottom: 0;
        }

        .btn {
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 56px;
            border: 0;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--gold-soft), var(--gold-deep));
            color: var(--white);
            font-size: 1.75rem;
            font-weight: 800;
            cursor: pointer;
            padding: 16px 0;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 80%;
            height: 100%;
            background: linear-gradient(
                105deg,
                transparent 0%,
                rgba(255, 255, 255, 0) 25%,
                rgba(255, 255, 255, 0.3) 50%,
                rgba(255, 255, 255, 0) 75%,
                transparent 100%
            );
            animation: btn-shine 5s ease-in-out infinite;
        }

        @keyframes btn-shine {
            0% {
                left: -100%;
            }

            60%,
            100% {
                left: 125%;
            }
        }

        .btn:hover {
            filter: brightness(1.05);
        }

        .recent-applicants {
            display: grid;
            gap: 16px;
            width: 100%;
            padding: 24px;
            border: 2px solid var(--orange-line);
            border-radius: 28px;
            background: var(--orange-card);
            box-shadow:
                0 10px 24px rgba(226, 98, 47,0.08),
                0 2px 6px rgba(226, 98, 47,0.05);
            box-sizing: border-box;
        }

        .recent-applicants-title {
            margin: 0;
            font-size: 1.3rem;
            font-weight: 800;
            text-align: center;
            letter-spacing: -0.03em;
            color: var(--ink);
        }

        .recent-applicants-head,
        .recent-applicants-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            width: 100%;
        }

        .recent-applicants-head {
            height: 44px;
            background: rgba(226, 98, 47,0.1);
            color: var(--gold);
            font-size: 0.82rem;
            font-weight: 700;
            border-radius: 14px 14px 0 0;
        }

        .recent-applicants-head > div,
        .recent-applicants-row > div {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 0;
            padding: 0 6px;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .recent-applicants-viewport {
            margin-top: -16px;
            max-height: 200px;
            overflow: hidden;
            border: 1px solid rgba(226, 98, 47,0.3);
            border-top: 0;
            border-radius: 0 0 14px 14px;
        }

        .recent-applicants-track {
            display: flex;
            flex-direction: column;
            transform: translateY(0);
            will-change: transform;
        }

        .recent-applicants-track.is-rolling {
            transition: transform 0.45s ease;
        }

        .recent-applicants-row {
            height: 50px;
            flex: none;
            border-bottom: 1px solid rgba(15, 27, 45, 0.1);
            background: var(--card);
            color: var(--dark-ink);
            font-size: 0.82rem;
        }

        .recent-applicants-empty {
            margin: 0;
            padding: 24px;
            border: 1px dashed var(--orange-line);
            border-radius: 20px;
            text-align: center;
            color: var(--sub);
        }

        /* ---- 하단 사업자 정보 ---- */
        .consult-footer {
            margin-top: 12px;
            background: #fffaea;
            border-radius: 12px;
            overflow: hidden;
        }

        .consult-footer__title {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 16px;
            border: 0;
            background: none;
            color: var(--sub);
            font-family: inherit;
            font-size: 0.78rem;
            letter-spacing: -0.03em;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .consult-footer__title:hover {
            color: var(--ink);
        }

        .consult-footer__chevron {
            width: 14px;
            height: 14px;
            color: currentColor;
            transition: transform 0.2s ease;
        }

        .consult-footer__title[aria-expanded='true'] .consult-footer__chevron {
            transform: rotate(180deg);
        }

        .consult-footer__text {
            -webkit-user-select: none;
            user-select: none;
            margin: 0;
            padding: 0 16px 14px;
            border-top: 1px solid rgba(226, 98, 47, 0.1);
            padding-top: 12px;
            color: var(--sub);
            font-size: 0.74rem;
            line-height: 1.6;
            letter-spacing: -0.03em;
            word-break: keep-all;
            text-align: center;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(4, 10, 24, 0.6);
            padding: 20px;
            z-index: 100;
        }

        .modal-overlay[hidden] {
            display: none;
        }

        .modal-card {
            width: 100%;
            max-width: 340px;
            background: var(--card);
            border-radius: 24px;
            padding: 32px 28px 28px;
            text-align: center;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.4);
            animation: modal-pop 0.25s ease;
        }

        @keyframes modal-pop {
            from {
                opacity: 0;
                transform: scale(0.92) translateY(8px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .modal-icon {
            width: 56px;
            height: 56px;
            box-sizing: border-box;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            line-height: 1;
            background: rgba(226, 98, 47,0.12);
            border-radius: 999px;
        }

        .modal-icon--warning {
            background: #fff3cd;
        }

        .modal-card h3 {
            margin: 0 0 8px;
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--dark-ink);
        }

        .modal-card p {
            margin: 0 0 20px;
            color: #6b7280;
            font-size: 0.92rem;
            line-height: 1.6;
        }

        .modal-card .btn {
            min-height: 48px;
        }

        @media (max-width: 640px) {
            .item,
            .form-section,
            .recent-applicants {
                padding: 18px;
                border-radius: 22px;
            }

            .recent-applicants-head {
                height: 36px;
                font-size: 0.78rem;
            }

            .recent-applicants-viewport {
                max-height: 140px;
            }

            .recent-applicants-row {
                height: 36px;
                font-size: 0.8rem;
            }
        }

        /* 좁은 폰 화면 대응 */
        @media (max-width: 400px) {
            body {
                padding: 8px;
            }

            .item,
            .form-section,
            .recent-applicants {
                padding: 16px;
            }

            .recent-applicants-head,
            .recent-applicants-row {
                font-size: 0.74rem;
            }

            .page-title {
                gap: 5px;
                padding: 10px 10px;
                font-size: 16px;
            }
        }
    </style>

    <title>임플란트 상담 신청</title>
</head>

<body>
    <!-- Google Tag Manager (noscript): 위 head 코드와 같은 GTM ID로 교체 필요 -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-XXXXXXX" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <section class="consult-hero-img">
        <p>
            <img src="https://knockknockplant.co.kr/landing/00-test/landing_v04/im-20_02.gif" alt="">
        </p>
    </section>

    <section class="item">
        <div class="item__top">
            <h2 class="choice-heading">👉 원하시는 항목을 선택해 주세요</h2>
        </div>
        <div class="choice-select-wrap">
            <button type="button" class="choice-select" id="choice-select-btn" aria-haspopup="listbox"
                aria-expanded="false">
                <span class="choice-select__value" id="choice-select-value">1개~2개 임플란트</span>
                <span class="choice-select__arrow" aria-hidden="true"></span>
            </button>
            <ul class="choice-options" id="choice-options" role="listbox" aria-label="상담 종류 선택" hidden>
                <li class="choice-option is-selected" role="option" aria-selected="true" data-value="1개~2개 임플란트">1개~2개
                    임플란트</li>
                <li class="choice-option" role="option" aria-selected="false" data-value="여러 개 임플란트">여러 개 임플란트</li>
                <li class="choice-option" role="option" aria-selected="false" data-value="전체 임플란트">전체 임플란트</li>
            </ul>
        </div>
    </section>

    <section class="form-section">
        <!-- <p class="eyebrow">📝 상담 신청</p> -->
        <div class="event-remaining">
            <span class="event-remaining__dot" aria-hidden="true"></span>
            <p class="event-remaining__text">남은 이벤트 수량: <span class="event-remaining__count"
                    id="event-remaining-count">78</span><span class="event-remaining__unit">개</span></p>
        </div>

        <!-- <div class="section-heading">
            <h2>임플란트 20만원 혜택 받으세요</h2>
            <p class="sub-title">(서울 / 수도권 거주자 한정)</p>
            <p class="desc">상담은 무료이며, 추가 비용 없이 안내된 금액 그대로 진행됩니다</p>
        </div> -->

        <!--구글시트탭: 웹앱 URL 주소-->
        <form class="consult-form" id="consult-form"
            action="https://script.google.com/macros/s/AKfycbxJ4XFbV8UYyUKaeX-Mw3XB1-O9ukw6qcWH9kY-fiFdH0JuAbV5XDtWSk6VTaG5J8vv_Q/exec"
            method="post">
            <input type="hidden" id="selected-type" name="selectedType" value="1개~2개 임플란트">
            <input type="hidden" id="client-ip" name="ip" value="">
            <input type="hidden" id="force-fail-flag" name="forceFail" value="0">
            <label class="field">
                <span>이름</span>
                <div class="input-icon">
                    <svg class="input-icon__svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 20c0-4.2 3.6-7 8-7s8 2.8 8 7" />
                    </svg>
                    <input type="text" name="name" placeholder="이름을 입력하세요" maxlength="4" autocomplete="off" required>
                </div>
            </label>

            <label class="field">
                <span>연락처</span>
                <div class="input-icon">
                    <svg class="input-icon__svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                        <path
                            d="M6.5 3h3l1.5 4.5-2 1.5a12 12 0 0 0 6 6l1.5-2 4.5 1.5v3a2 2 0 0 1-2 2c-8 0-14.5-6.5-14.5-14.5a2 2 0 0 1 2-2Z" />
                    </svg>
                    <input type="tel" name="phone" placeholder="연락처를 입력하세요" maxlength="13" autocomplete="off" required>
                </div>
            </label>

            <button class="btn" type="submit">맞춤 견적 신청하기</button>

            <button type="button" id="debug-force-fail-btn" class="btn"
                style="display:none; background:#666; margin-bottom:10px;">🧪 일부러 실패시키기 (테스트용)</button>

            <div class="agree-panel">
                <label class="agree-panel__row">
                    <input type="checkbox" name="agree" required checked>
                    <span><strong>[필수]</strong> 개인정보 수집 및 이용에 동의합니다.</span>
                </label>
                <button type="button" class="agree-panel__toggle" id="agree-detail-toggle" aria-expanded="false"
                    aria-controls="agree-detail-panel">
                    <span>개인정보취급방침 보기</span>
                    <svg class="agree-panel__chevron" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                        <path d="M6 9l6 6 6-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <div class="agree-panel__detail" id="agree-detail-panel" hidden>
                    <p class="agree-panel__detail-title">개인정보취급방침</p>
                    <div class="agree-panel__detail-block">
                        <p class="agree-panel__detail-heading">가. 수집하는 개인정보 항목 및 수집방법</p>
                        <p class="agree-panel__detail-text">- 신청자 이름, 핸드폰</p>
                    </div>
                    <div class="agree-panel__detail-block">
                        <p class="agree-panel__detail-heading">나. 개인정보의 수집 및 이용목적</p>
                        <p class="agree-panel__detail-text">수집한 개인정보를 다음의 목적을 위해 활용합니다.</p>
                        <p class="agree-panel__detail-text">- 담당자들의 전화 상담</p>
                    </div>
                    <div class="agree-panel__detail-block">
                        <p class="agree-panel__detail-heading">다. 수집한 개인정보의 보유 및 이용기간</p>
                        <p class="agree-panel__detail-text">- 원칙적으로 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체 없이 파기합니다.</p>
                    </div>
                    <div class="agree-panel__detail-block">
                        <p class="agree-panel__detail-heading">라. 동의 거부권 안내</p>
                        <p class="agree-panel__detail-text">- 동의를 거부할 경우 신청정보가 제공되지 않습니다.</p>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <section class="consult-footer">
        <button type="button" class="consult-footer__title" id="footer-detail-toggle" aria-expanded="false"
            aria-controls="footer-detail-text">
            <span>사업자정보</span>
            <svg class="consult-footer__chevron" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <path d="M6 9l6 6 6-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
        <p class="consult-footer__text" id="footer-detail-text" hidden>상호명 : 똑똑플란트치과의원 | 대표자 : 손동국 | 사업자등록번호 :
            844-58-00681</p>
    </section>
    <div class="modal-overlay" id="app-modal" hidden>
        <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="app-modal-title">
            <div class="modal-icon" id="app-modal-icon">✅</div>
            <h3 id="app-modal-title">맞춤 견적 알아보기 신청이 완료되었습니다.</h3>
            <p id="app-modal-message">빠른 시간 안에 상담원이 연락드리겠습니다.</p>
            <button type="button" class="btn" id="app-modal-confirm">확인</button>
        </div>
    </div>

    <script>
        // ==== js/index4.js ====
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
            const phone = normalizePhone(String(formData.get('phone') || '').trim());
            const agree = formData.get('agree') === 'on';
            const selectedType = String((selectedTypeInput && selectedTypeInput.value) || '').trim() || '1개~2개 임플란트';

            formData.set('selectedType', selectedType);

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

            let resultText = '';
            try {
                const response = await fetch(API_URL, {
                    method: 'POST',
                    body: formData,
                });
                resultText = (await response.text()).trim();
            } catch (error) {
                console.error('submit_consult_form_error', error);
                resultText = 'network_error';
            }

            waitingForResponse = false;
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.textContent = '맞춤 견적 알아보기';
            }

            if (resultText === 'rate_limited') {
                showModal({
                    icon: '⚠️',
                    title: '이미 신청을 하셨습니다',
                    message: '잠시 후 다시 시도해주세요.',
                    tone: 'warning',
                });
                return;
            }

            // rate_limited를 제외한 나머지(성공/서버 내부 오류/네트워크 오류)는 결과와 무관하게 완료 메시지를 유지한다.
            // 서버 내부 오류는 doPost에서 DB로스 시트로 백업되므로 신청 데이터 자체는 유실되지 않는다.
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

        // 임시 테스트 코드: DB로스 유실 테스트용. 테스트 끝나면 이 블록과 #debug-force-fail-btn, #force-fail-flag 삭제할 것
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
    </script>
</body>

</html>
