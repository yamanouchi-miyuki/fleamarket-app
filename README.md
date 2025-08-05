# coachtech フリマアプリ

## 環境構築
**Dockerビルド**
1. このリポジトリをクローン
```bash
git clone git@github.com:yamanouchi-miyuki/fleamarket-app.git
```
2. DockerDesktopを起動
3. Dockerコンテナをビルド・起動
```bash
docker-compose up -d --build
```

> *MacのM1・M2チップのPCの場合、`no matching manifest for linux/arm64/v8 in the manifest list entries`のメッセージが表示されビルドができないことがあります。
エラーが発生する場合は、docker-compose.ymlファイルの「mysql」内に「platform」の項目を追加で記載してください。またM3チップの場合は、version3.8を削除、platform: linux/amd64 の記載が必要な場合があります*

```yaml
mysql:
    platform: linux/x86_64(この行を追加)
    image: mysql:8.0.26
    environment:
```

**Laravel環境構築**
1. PHPコンテナに入る
```bash
docker-compose exec php bash
```
2. パッケージをインストールする
```bash
composer install
```
3. 新しく.envファイルを作成
```bash
touch .env
```
4. .envに以下の環境変数を追加
```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5. アプリケーションキーの作成
```bash
php artisan key:generate
```
6. マイグレーションの実行
```bash
php artisan migrate
```
7. シーディングの実行
```bash
php artisan db:seed
```

## 使用技術(実行環境)
- PHP8.3.0
- Laravel8.83.27
- MySQL8.0.26
- Docker + docker-compose

## ER図
![ER図](public/erd.png)

## URL
- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/
