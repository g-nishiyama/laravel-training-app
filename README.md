# 事前準備
1. node.jsとnpmをインストールする
2. composerをインストールする


# 導入方法
1.プロジェクトをGitからクローンする
> git clone https://github.com/g-nishiyama/laravel-training-app.git

2.「.env.example」を複製して「.env」にリネームする

3.ターミナルから下記を実行してAPP_KEYを生成
> php artisan key:generate

4.プロジェクトにcomposerをインストール（venderフォルダ作成）
> composer install

5.DBの作成とテーブル作成
> pnp artisan migrate


# 起動方法

1.サーバー起動
> php artisan serve

2.laravel/ui反映（Node.jsバージョン古いと動かない可能性あり）
> npm run dev

3.XAMPPでMySQLを起動する
