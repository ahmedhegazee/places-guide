<?php

use App\Models\BloodType;
use App\Models\Category;
use App\Models\Permission;
use App\Models\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GovernsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        // $this->call(ClientsTableSeeder::class);
        DB::statement("INSERT INTO permissions (id, name, display_name, description, created_at, updated_at, permissions_group, routes) VALUES
('1', 'add-post', 'اضافة مقال', NULL, '2020-08-23 09:06:15', '2020-08-23 09:08:02', 'مقالات', 'post.create,post.store'),
('2', 'edit-post', 'تعديل مقال', NULL, '2020-08-23 09:06:15', '2020-08-23 09:07:55', 'مقالات', 'post.edit,post.update'),
('3', 'delete-post', 'حذف مقال', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'مقالات', 'post.destroy'),
('4', 'add-users', 'اضافة مستخدمين', NULL, '2020-08-23 09:07:07', '2020-08-23 09:07:41', 'مستخدمين', 'user.create,user.store'),
('5', 'edit-user', 'تعديل مستخدم', NULL, '2020-08-23 09:07:34', '2020-08-23 09:07:34', 'مستخدمين', 'user.edit,user.update'),
('7', 'delete-user', 'حذف مستخدم', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'مستخدمين', 'user.destroy'),
('8', 'show-users', 'عرض مستخدمين', NULL, '2020-08-23 09:07:07', '2020-08-23 09:07:41', 'مستخدمين', 'user.index'),
('15', 'add-category', 'اضافة تصنيف', NULL, '2020-08-23 09:06:15', '2020-08-23 09:08:02', 'تصنيفات', 'category.create,category.store'),
('16', 'edit-category', 'تعديل تصنيف', NULL, '2020-08-23 09:06:15', '2020-08-23 09:07:55', 'تصنيفات', 'category.edit,category.update'),
('17', 'delete-category', 'حذف تصنيف', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'تصنيفات', 'category.destroy'),
('18', 'add-role', 'اضافة رتبة', NULL, '2020-08-23 09:07:07', '2020-08-23 09:07:41', 'رتب', 'role.create,role.store'),
('19', 'edit-role', 'تعديل رتبه', NULL, '2020-08-23 09:07:34', '2020-08-23 09:07:34', 'رتب', 'role.edit,role.update'),
('20', 'show-categories', 'عرض تصنيفات', NULL, '2020-08-23 09:06:15', '2020-08-23 09:08:02', 'تصنيفات', 'category.index'),
('21', 'delete-role', 'حذف رتبة', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'رتب', 'role.destroy'),
('22', 'show-roles', 'عرض رتب', NULL, '2020-08-23 09:07:07', '2020-08-23 09:07:41', 'رتب', 'role.index'),
('23', 'edit-government', 'تعديل محافظة', NULL, '2020-08-23 09:07:34', '2020-08-23 09:07:34', 'محافظة', 'government.edit,government.update'),
('24', 'show-governments', 'عرض محافظة', NULL, '2020-08-23 09:06:15', '2020-08-23 09:08:02', 'محافظة', 'government.index'),
('25', 'delete-government', 'حذف محافظة', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'محافظة', 'government.destroy'),
('26', 'add-government', 'اضافة محافظة', NULL, '2020-08-23 09:07:07', '2020-08-23 09:07:41', 'محافظة', 'government.store,government.create'),
('27', 'edit-city', 'تعديل مدينة', NULL, '2020-08-23 09:07:34', '2020-08-23 09:07:34', 'مدن', 'city.edit,city.update'),
('28', 'show-cities', 'عرض مدن', NULL, '2020-08-23 09:06:15', '2020-08-23 09:08:02', 'مدن', 'city.index'),
('29', 'delete-city', 'حذف مدينة', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'مدن', 'city.destroy'),
('30', 'add-city', 'اضافة مدينة', NULL, '2020-08-23 09:07:07', '2020-08-23 09:07:41', 'مدن', 'city.store,city.create'),
('31', 'show-posts', 'عرض مقالات', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'مقالات', 'post.index'),
('32', 'delete-client', 'حذف عميل', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'عملاء', 'client.destroy'),
('33', 'show-clients', 'عرض عملاء', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'عملاء', 'client.index'),
('34', 'delete-request', 'حذف طلب تبرع', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'طلبات تبرع', 'request.destroy'),
('35', 'show-requests', 'عرض طلبات التبرع', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'طلبات تبرع', 'request.index');
");
        $role = Role::create([
            'name' => 'admin',
            'display_name' => 'مدير الموقع',
        ]);
        $role->permissions()->attach(Permission::all('id'));
        $user  = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);
        $user->roles()->attach(1);
        $this->call(PlaceOwnersTableSeeder::class);
        $this->call(OwnerRequestTableSeeder::class);
        $this->call(DiscountsTableSeeder::class);
        $this->call(WorkAdsTableSeeer::class);
    }
}