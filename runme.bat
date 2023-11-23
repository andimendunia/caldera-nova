@echo off
echo.
echo Menjalankan NPM...
start npm run dev
echo Menjalankan server PHP...
start php artisan serve
echo.
echo ===================================
echo.
echo Ingin buka Caldera Nova di browser?
echo.
echo ==================================
echo.
choice /c yt /n /m "Masukkan Y atau T: "

IF ERRORLEVEL == 2 GOTO T
IF ERRORLEVEL == 1 GOTO Y
GOTO END

:T
ECHO Baiklah.
ECHO.
ECHO Tekan apapun untuk menutup jendela ini.
Echo.
pause
GOTO END

:Y
ECHO Membuka browser...
start http://127.0.0.1:8000

:END
exit