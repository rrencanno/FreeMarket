# お問い合わせフォーム

## 環境構築

### Docker ビルド

1. `git clone https://github.com/rrencanno/mogitate_site`
2. `docker-compose up -d --build`

> **Note**
> MySQL が環境によって正常に起動しない場合は、各 PC に合わせて`docker-compose.yml` ファイルを編集してください。

### Laravel 環境構築

1. `docker-compose exec php bash`
2. `composer install`
3. `cp .env.example .env`

    `.env` ファイルの環境変数を変更:

    ```
    ・12行目 → DB_HOST = mysql
    ・14行目 → DB_DATABASE = laravel_db
    ・15行目 → DB_USERNAME = laravel_user
    ・16行目 → DB_PASSWORD = laravel_pass
    ```

4. `php artisan key:generate`
5. `php artisan migrate`
6. `php artisan db:seed`
7. `php artisan storage:link`
8. `exit`
9. `rsync -av img/ src/storage/app/public/`
10. この項は「商品登録」や「商品詳細ページでの画像の変更」時に、画像ファイルが2MB以上になる場合に実行する。

    ※ 画像ファイルが2MB以上になると413 Request Entity Too Largeエラーが発生するため

    ・`docker exec -it mogitate_site-nginx-1 bash`

    ・`apt update && apt install nano`

    ・`nano /etc/nginx/conf.d/default.conf`

    ・default.conf に以下を追加

    ```
    server {
        ...
        client_max_body_size 20M;  # 20MBまでアップロード可能
    }
    ```

    ・`exit`

    ・`docker exec -it mogitate_site-nginx-1 nginx -s reload`

## 使用技術 (実行環境)

- **PHP** 7.4.9
- **Laravel** 8.83.8
- **MySQL** 8.0.26

## ER 図
![ER図][mogitate_site.drawio.png](mogitate_site.drawio.png)

## URL

- **phpMyAdmin**：[http://localhost:8080](http://localhost:8080)
- **商品一覧画面**：[http://localhost/products](http://localhost/products)
