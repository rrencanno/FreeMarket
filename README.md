# お問い合わせフォーム

## 環境構築

### Docker ビルド

1. `git clone https://github.com/rrencanno/test1`
2. `docker-compose up -d --build`

> **Note**
> MySQL が環境によって正常に起動しない場合は、各 PC に合わせて`docker-compose.yml` ファイルを編集してください。

### Laravel 環境構築

1. `docker-compose exec php bash`
2. `composer install`
3. `.env.example` ファイルから `.env` を作成し、環境変数を変更
4. `php artisan key:generate`
5. `php artisan migrate`
6. `php artisan db:seed`

## 使用技術 (実行環境)

- **PHP** 7.4.9
- **Laravel** 8.83.8
- **MySQL** 8.0.26

## ER 図
![ER図][test1.drawio.png](test1.drawio.png)

## URL

- **開発環境**：[http://localhost](http://localhost)
- **phpMyAdmin**：[http://localhost:8080](http://localhost:8080)
