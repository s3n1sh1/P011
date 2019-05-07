echo off
php artisan krlove:generate:model TBLNOR --table-name=TBLNOR
php artisan krlove:generate:model TBLUSR --table-name=TBLUSR
php artisan krlove:generate:model TBLMNU --table-name=TBLMNU
php artisan krlove:generate:model TBLUAM --table-name=TBLUAM
php artisan krlove:generate:model TBLDSC --table-name=TBLDSC
php artisan krlove:generate:model TBLSYS --table-name=TBLSYS
echo SUDAH SELESAI GENERATE MODEL
pause