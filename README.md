# お問い合わせフォーム

## 環境構築

### Dockerビルド
1. リポジトリをクローン
   ```bash
   git clone https://github.com/sametyan9999/test-contactform1.git
   cd test-contactform1
2. コンテナをビルド・起動
   docker-compose up -d --build

※ MySQL が OS によって起動しない場合があるので、それぞれのPCに合わせて docker-compose.yml を編集してください。

### Laravel環境構築
1. コンテナを起動
docker-compose up -d --build

2. PHPコンテナに入る
docker-compose exec php bash

3. Laravel本体のあるフォルダへ移動
cd src

4. 依存関係をインストール
composer install

5. .env ファイルを作成・編集
cp .env.example .env
↓ 編集（DB設定をDocker用に修正）
DB_HOST=mysql
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

6. アプリケーションキーを生成
php artisan key:generate

7. マイグレーションを実行
php artisan migrate

8. シーディングを実行
php artisan db:seed

## 使用技術(実行環境)
•	PHP 8.1
•	Laravel 8.x
•	MySQL 8.0
•	Docker / Docker Compose
•	phpMyAdmin
•	Laravel Fortify（認証機能）

## ER図
![ER Diagram](./images/erdiagram.png)

## URL
•	開発環境: http://localhost
•	phpMyAdmin: http://localhost:8080