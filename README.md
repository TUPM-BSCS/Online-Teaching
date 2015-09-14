# Online-Teaching
Macaranas, Erni, Gallardo, Policarpio, Vicente, Mirabueno

Guidelines:
* Go to localhost/phpmyadmin and create a database named onlineteaching
* Open cmd.exe, change directory (accdng to where you placed the project)
* type: php artisan migrate

Initial User Set Up (add roles and main admin), Type the ff in cmd
* php artisan tinker
* $role = App\Role::create('name'=>'Main Administrator');
* $role = App\Role::create('name'=>'Institution Administrator');
* $role = App\Role::create('name'=>'Professor');
* $role = App\Role::create('name'=>'Student');
* $user = App\User::create('name'=>'Main Administrator', 'email'=>'admin@philed.com', 'password'=>bcrypt('philedmainadmin'), 'is_verified'=>'true', 'role_id'=>'1');

URLs:
* Main admin login: ../auth/login/main_admin

Registration links:
* Main admin - ../auth/register/main_admin
* Inst admin - ../auth/register/institution
* Prof - ../auth/register/professor
* Student - ../auth/register/student

