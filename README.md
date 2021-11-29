git clone https://github.com/dralexsand/greenwaytest.git

cd greenwaytest

create and configure database

composer update

composer require laravel/ui php artisan ui vue --auth composer require laravel/passport

php artisan migrate

php artisan db:seed

Setting Passport:

in app/Models/User.php, app/Providers/AuthServiceProvider.php, config/auth.php, routes/api.php

php artisan serve

The site is available at http://127.0.0.1:8000

*****************************************

Тестовое задание

1) PostgreSql

Есть таблица users, user_carts, orders, order_items

0. Реализовать связь этих таблиц.
1. Написать запрос создания всех 4 таблиц со связями. Реализация средствами Laravel описано в папке database/migrations

Средствами PostgreSQL:

users:

```
CREATE TABLE IF NOT EXISTS public.users
(
id bigint NOT NULL, name character varying(255) COLLATE pg_catalog."default" NOT NULL, email character varying(255)
COLLATE pg_catalog."default" NOT NULL, email_verified_at timestamp(0) without time zone, password character varying(255)
COLLATE pg_catalog."default" NOT NULL, remember_token character varying(100) COLLATE pg_catalog."default", created_at
timestamp(0) without time zone, updated_at timestamp(0) without time zone, CONSTRAINT users_pkey PRIMARY KEY (id),
CONSTRAINT users_email_unique UNIQUE (email)
);

ALTER TABLE IF EXISTS public.users OWNER to postgres;

```

orders:

```
CREATE TABLE IF NOT EXISTS public.orders
(
id bigint NOT NULL, name character varying(256) COLLATE pg_catalog."default" NOT NULL, cost bigint NOT NULL, created_at
timestamp(0) without time zone, updated_at timestamp(0) without time zone, CONSTRAINT orders_pkey PRIMARY KEY (id)
);

ALTER TABLE IF EXISTS public.orders OWNER to postgres;
```

user_carts:

```
CREATE TABLE IF NOT EXISTS public.user_carts
(
id bigint NOT NULL, user_id bigint NOT NULL, card_number character varying(20) COLLATE pg_catalog."default" NOT NULL,
created_at timestamp(0) without time zone, updated_at timestamp(0) without time zone, CONSTRAINT user_carts_pkey PRIMARY
KEY (id), CONSTRAINT user_carts_user_id_foreign FOREIGN KEY (user_id)
REFERENCES public.users (id) MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE IF EXISTS public.user_carts OWNER to postgres;
```

order_items:

```
CREATE TABLE IF NOT EXISTS public.order_items
(
id bigint NOT NULL, user_id bigint NOT NULL, order_id bigint NOT NULL, created_at timestamp(0) without time zone,
updated_at timestamp(0) without time zone, CONSTRAINT order_items_pkey PRIMARY KEY (id), CONSTRAINT
order_items_order_id_foreign FOREIGN KEY (order_id)
REFERENCES public.orders (id) MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE, CONSTRAINT order_items_user_id_foreign
FOREIGN KEY (user_id)
REFERENCES public.users (id) MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE IF EXISTS public.order_items OWNER to postgres;
```

2. Написать запрос добавления тестовых данных в эти таблицы. Реализацию средствами Laravel можно посмотреть в database/factories,
   database/seeders

3. Написать запрос для вывода одной таблицы, которая содержит эти данные:
   user.id, user.name, orders.id, order_items.id, order_items.name, orders.created_at
   ```
   SELECT users.id AS user_id, users.name AS user_name, orders.id AS orders_id, order_items.id AS order_items_id,
   orders.name AS order_items_name, orders.created_at AS orders_created_at FROM order_items JOIN users ON
   users.id=order_items.user_id JOIN orders ON orders.id=order_items.order_id;
   ```

5. Написать запрос удаления. Запрос должен удалять пользователя, корзину и все его заказы. DELETE FROM users WHERE id =
   1;
   ```
   DELETE FROM users WHERE users.id IN (9);
   ```

2) Laravel. Можно без БД.

3) Реализовать авторизацию
Auth
4) Реализовать проверку токена
Passport

5) Реализовать метод получения одного пользователя
6) Реализовать метод получения всех пользователей
7) Реализовать метод изменения одного пользователя
8) Реализовать метод изменения нескольких пользователей по id
9) Реализовать метод удаления одного пользователя
10) Реализовать метод удаления нескольких пользователей по id

Реализацию можно посмотреть в
routes/web.php и app/Http/Controllers/UserController.php
