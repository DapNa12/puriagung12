@echo off
echo ============================================
echo  Fix PHP Path - Upgrade ke PHP 8.2
echo ============================================
echo.
echo Mengganti C:\xampp\php (7.4) dengan C:\php82 (8.2)
echo di system PATH...
echo.
setx Path "%Path:C:\xampp\php=C:\php82%" /M
echo.
if %ERRORLEVEL% EQU 0 (
    echo [SUKSES] PHP default sekarang 8.2
    echo Silakan tutup dan buka ulang terminal/PowerShell
) else (
    echo [GAGAL] Jalankan file ini sebagai ADMINISTRATOR
    echo Klik kanan - Run as Administrator
)
echo.
pause
