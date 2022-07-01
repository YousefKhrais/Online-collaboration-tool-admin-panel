# Online Collaboration Tool Admin Panel

Admin Panel for https://github.com/YousefKhrais/Online-collaboration-tool
A web-based education tool that aims to make learning programming more interactive between teachers and students

## Installation Steps:

Clone installation GIT repository on the master host

```
git clone https://github.com/YousefKhrais/Online-collaboration-tool-admin-panel
```

Install npm packages

```
npm install

npm run dev
```

Install laravel packages

```
copmoser install
```
Migrate the database schema

```
php artisan migrate --seed
```

Start the laravel server

```
php artisan serve --host 0.0.0.0 --port 8000
```
