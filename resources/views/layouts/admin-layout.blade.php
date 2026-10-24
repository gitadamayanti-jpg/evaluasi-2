
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REPLAY Admin</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 240px;
            flex-shrink: 0;
            background: #172b4d;
            color: white;
            padding: 28px 18px;
        }

        .brand {
            display: block;
            color: white;
            font-size: 25px;
            font-weight: bold;
            text-decoration: none;
            margin-bottom: 25px;
        }

        .report-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #4263eb;
            color: white;
            font-size: 14px;
            cursor: pointer;
            margin-bottom: 30px;
        }

        .sidebar nav {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .nav-link {
            display: block;
            padding: 12px;
            border-radius: 7px;
            color: #dbe5f5;
            text-decoration: none;
        }

        .nav-link:hover {
            background: #294267;
            color: white;
        }

        .main-content {
            flex: 1;
            min-width: 0;
            padding: 32px;
        }

        @media (max-width: 700px) {
            .admin-wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .main-content {
                padding: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="admin-wrapper">
        <aside class="sidebar">
            <a href="{{ route('digicam.index') }}" class="brand">
                REPLAY
            </a>

            <button type="button" class="report-button">
                + New Report
            </button>

            <nav>
                <a href="{{ route('digicam.index') }}" class="nav-link">
                    Dashboard
                </a>

                <a href="{{ route('digicam.index') }}" class="nav-link">
                    Daftar Digicam
                </a>
            </nav>
        </aside>

        <main class="main-content">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
