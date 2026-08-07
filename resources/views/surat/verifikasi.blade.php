<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verifikasi Surat | Desa Wates</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(22, 163, 74, 0.08), transparent 35%),
                linear-gradient(135deg, #f8fafc, #eefbf3);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: #1f2937;
        }

        .verification-wrapper {
            width: 100%;
            max-width: 620px;
        }

        .verification-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 45px 35px;
            text-align: center;
            box-shadow:
                0 20px 45px rgba(15, 23, 42, 0.08),
                0 4px 12px rgba(15, 23, 42, 0.04);
            border: 1px solid #e5e7eb;
            position: relative;
            overflow: hidden;
        }

        .verification-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(
                90deg,
                #15803d,
                #22c55e,
                #15803d
            );
        }

        .logo-area {
            margin-bottom: 25px;
        }

        .logo-placeholder {
            width: 75px;
            height: 75px;
            margin: auto;
            border-radius: 50%;
            background: #f0fdf4;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #bbf7d0;
        }

        .logo-placeholder svg {
            width: 38px;
            height: 38px;
            stroke: #15803d;
        }

        .status-icon {
            width: 105px;
            height: 105px;
            border-radius: 50%;
            background: #dcfce7;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 25px;
            position: relative;
            transform: scale(0);
            animation: popIcon 0.6s ease forwards;
        }

        .status-icon::after {
            content: "";
            position: absolute;
            width: 125px;
            height: 125px;
            border-radius: 50%;
            border: 2px solid rgba(34, 197, 94, 0.16);
            animation: pulseRing 2s infinite;
        }

        .checkmark {
            width: 50px;
            height: 28px;
            border-left: 7px solid #16a34a;
            border-bottom: 7px solid #16a34a;
            transform: rotate(-45deg);
            margin-top: -8px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 15px;
            border-radius: 100px;
            background: #f0fdf4;
            color: #15803d;
            border: 1px solid #bbf7d0;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 18px;
            letter-spacing: 0.4px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #22c55e;
            border-radius: 50%;
        }

        h1 {
            font-size: 26px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 14px;
            line-height: 1.35;
        }

        .verification-text {
            font-size: 18px;
            line-height: 1.7;
            color: #4b5563;
            margin-bottom: 28px;
        }

        .verification-text strong {
            color: #15803d;
        }

        .divider {
            width: 100%;
            height: 1px;
            background: #e5e7eb;
            margin: 28px 0;
        }

        .info-box {
            padding: 18px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            text-align: left;
            margin-bottom: 25px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            padding: 8px 0;
        }

        .info-row:not(:last-child) {
            border-bottom: 1px dashed #d1d5db;
        }

        .info-label {
            color: #6b7280;
            font-size: 14px;
        }

        .info-value {
            color: #111827;
            font-size: 14px;
            font-weight: 600;
            text-align: right;
        }

        .security-info {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 7px;
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 25px;
        }

        .security-info svg {
            width: 16px;
            height: 16px;
            stroke: #15803d;
        }

        .btn {
            border: none;
            outline: none;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            min-height: 46px;
            padding: 0 24px;
            border-radius: 12px;
            background: #15803d;
            color: white;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.25s ease;
        }

        .btn:hover {
            background: #166534;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(21, 128, 61, 0.18);
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #94a3b8;
            font-size: 12px;
            line-height: 1.7;
        }

        .toast {
            position: fixed;
            right: 20px;
            bottom: 20px;
            background: #111827;
            color: white;
            padding: 13px 18px;
            border-radius: 10px;
            font-size: 13px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            opacity: 0;
            transform: translateY(20px);
            pointer-events: none;
            transition: 0.3s;
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes popIcon {
            0% {
                transform: scale(0);
            }

            70% {
                transform: scale(1.12);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes pulseRing {
            0% {
                transform: scale(0.85);
                opacity: 1;
            }

            100% {
                transform: scale(1.2);
                opacity: 0;
            }
        }

        @media (max-width: 576px) {
            .verification-card {
                padding: 38px 22px;
                border-radius: 18px;
            }

            h1 {
                font-size: 22px;
            }

            .verification-text {
                font-size: 16px;
            }

            .info-row {
                flex-direction: column;
                gap: 5px;
            }

            .info-value {
                text-align: left;
            }

            .status-icon {
                width: 90px;
                height: 90px;
            }

            .status-icon::after {
                width: 108px;
                height: 108px;
            }
        }
    </style>
</head>

<body>

<div class="verification-wrapper">

    <div class="verification-card">

        {{-- Logo / icon desa --}}
        <div class="logo-area">
            <div class="logo-placeholder">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.75 21h16.5M4.5 3.75h15M5.25 3.75V21m13.5-17.25V21M8.25 7.5h2.25m3 0h2.25m-7.5 3.75h2.25m3 0h2.25m-7.5 3.75h2.25m3 0h2.25"
                    />
                </svg>
            </div>
        </div>

        {{-- Icon terverifikasi --}}
        <div class="status-icon">
            <div class="checkmark"></div>
        </div>

        <div class="status-badge">
            <span class="status-dot"></span>
            DOKUMEN TERVERIFIKASI
        </div>

        <h1>Verifikasi Surat Berhasil</h1>

        <p class="verification-text">
            Surat ini sudah terverifikasi oleh
            <strong>Kepala Desa Wates</strong>.
        </p>

        <div class="divider"></div>

        {{-- Informasi tambahan --}}
        <div class="info-box">

            <div class="info-row">
                <span class="info-label">
                    Status
                </span>

                <span class="info-value" style="color:#15803d;">
                    Terverifikasi
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">
                    Instansi
                </span>

                <span class="info-value">
                    Pemerintah Desa Wates
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">
                    Verifikator
                </span>

                <span class="info-value">
                    Kepala Desa Wates
                </span>
            </div>

        </div>

        <div class="security-info">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16.5 10.5V6.75a4.5 4.5 0 00-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0119.5 12.75v6A2.25 2.25 0 0117.25 21H6.75A2.25 2.25 0 014.5 18.75v-6a2.25 2.25 0 012.25-2.25z"
                />
            </svg>

            Keaslian dokumen telah dikonfirmasi oleh sistem
        </div>

        <button
            type="button"
            class="btn"
            onclick="kembali()"
        >
            Kembali
        </button>

    </div>

    <div class="footer">
        Sistem Informasi Pemerintah Desa Wates
        <br>
        &copy; {{ date('Y') }} Desa Wates
    </div>

</div>


<div
    class="toast"
    id="toast"
>
    Surat telah terverifikasi.
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const toast = document.getElementById('toast');

        setTimeout(function () {
            toast.classList.add('show');
        }, 700);

        setTimeout(function () {
            toast.classList.remove('show');
        }, 3500);

    });


    function kembali() {

        if (window.history.length > 1) {
            window.history.back();
        } else {
            window.location.href = '/';
        }

    }
</script>

</body>
</html>
