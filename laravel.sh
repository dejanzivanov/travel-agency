laravel new $1
cd $1

composer require laravel/ui
php artisan ui vue
npm install
npm install vue-loader@^15.9.8 --save-dev --legacy-peer-deps
npm install vue@2.7.14
npm install bootstrap
npm install bootstrap-vue

printf "import 'bootstrap-vue/dist/bootstrap-vue.css'\n" | cat - resources/js/app.js > temp && mv temp resources/js/app.js
printf "import 'bootstrap/dist/css/bootstrap.css'\n" | cat - resources/js/app.js > temp && mv temp resources/js/app.js

phpstorm64 .
