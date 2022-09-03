<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{


$permissions = [
        
        'لوحة التحكم',
        'قبول ورفض الخدمات',
        'قبول ورفض الطلبات',
        'الطلبات',
        'جميع الطلبات ',
        'الطلبات المدفوعة',
        'الطلبات المدفوعة جزئيا',
        'الطلبات الغير مدفوعة',
        'ارشيف الطلبات',      
        'المستخدمين',
        'قائمة المستخدمين',
        'صلاحيات المستخدمين',
        'الاعدادات',
        'الاقسام',


        'اضافة طلب',
        'حذف طلب',
        'تصدير EXCEL',
        'تعديل الطلب',
        'ارشفة الطلب',
        'اضافة مرفق',
        'حذف المرفق',

        'اضافة مستخدم',
        'تعديل مستخدم',
        'حذف مستخدم',

        'عرض صلاحية',
        'اضافة صلاحية',
        'تعديل صلاحية',
        'حذف صلاحية',

        

        'اضافة قسم',
        'تعديل قسم',
        'حذف قسم',
       

];



foreach ($permissions as $permission) {

Permission::create(['name' => $permission]);
}


}
}
