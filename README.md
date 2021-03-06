# ローカル環境
* PHP 7.4.10
* Laravel 6.x
* NodeJs
* NuxtJs
* PostgreSQL 12.6
* Git

# デプロイ
* heroku Hobby PostgreSQL

選ばれるのは、heroku

# 技術選定
- バックエンド
  - PHP <br>
  特になし。Laravel 6.xが動けば良いため7.2以上のバージョンであれば何でもよかったため、レンタルサーバーでも多く使用されている7.4を使用。
  
  - Laravel 6.x<br>
  最新版は8.x（2021/5現在）だがLTS版が6.xのため、6.xを採用。8.xのsunctom認証やJetstreamは機会があれば別途学習する。
  
  - PostgreSQL 12.6<br>
  最新版は13.x（2021/5現在）だが、デプロイ先のherokuのPostgreSQLが12.x（2021/5現在）となっているため12.6をインストールする。

- フロントエンド
  - NuxtJS<br>
  フロント部分はSSRで行いたかったためNuxtを使用。
  
  - VueJS<br>
  Laravelに搭載されているもの。
  
  
# 選定背景
　バックエンド部は各CMSを利用する手段も視野にあったが、今回はLaravelでのSQL操作を通してデータベースへのアクセスも同時に学習したく、かつ期間内の完成を目指したかったためLaravelを採用。
  
　LaravelおよびNuxtは同一レポジトリではあるものの、LaravelはLaravel/uiを用いた管理画面、フロントはフロントで分けて開発を行い、Laravelではブログポストなどデータベースの各データを管理画面で編集しJSON形式で出力するAPIとして活用する。これにより、フロントエンドのレポジトリやフレームワークに寄らない開発を学習する。
  
　管理画面はLaravel/ui vueで開発する。管理画面は想定されるページ数に限りがあり、またSEO上、構造上ページが分かれていなくても問題なく画面自体も簡素でいいためSPAでの開発を行う。あと、うごきがかっこいいから。
  
　フロント部はSSRで作成する。SPAでのJSON-LDによる構造化や正規表現など欠点を克服し、SEOを行う面で効果的な開発を目指す。あと、うごきがかっこいいから。
  
  
　サーバーはheroku,Netlifyやfirebase,AWSと色々検討した結果、とりあえず学習用の個人利用でランニングコストもかからないherokuにする。万が一、良い意味でバズった場合はアップグレードも視野に入れようかと思うし、フロント部だけ分離してレンタルサーバーで運用しちゃう手もある。

>Git ←→ GitHub ←→ heroku server { NuxtJS ←→ Laravel(API) ←→　Laravel/ui vue (管理画面) }　←→　PostgreSQL<br>

# 環境構築

　ここより公式リファレンスや他記事の方が詳しく載っているため内容は割愛
 
 
 ### PHP、Apache

  * XAMPPをインストールしローカル環境にPHPとApacheの環境を構築する。
  * 初期設定ではPHP.iniにXdebugが無くextension = PDO_pg-sqlがコメントアウトしていたため有効にする。
  
### PostgreSQL
  * 公式からダウンロードしてインストールし、システム環境変数にPathを設定する。
  
テスト環境は
    * port:5432(初期設定)
    * user:user
    * password:pass
で構築


### VisualStudioCode

  * Html、Css、Javascript学習用に使用していたため、そのまま使用。
  * 各システムの拡張機能をインストールしておく。

### NodeJS
  * 公式から最新版をインストールしとく
  
### Git
  * 検討中

# 設計
  ### バックエンド
  
  - ユーザー認証（管理ユーザーと編集ユーザーで分ける）<br>
     WordpressのDB構造をある程度パクる
      - ID
      - 権限
      - 名前
      - mail
      - 登録年月日
     
  - ユーザー登録（管理ユーザーのみ）
      - 認証と同じ

  - 記事作成（全ユーザー）<br>
    Wordpressをパクる
      - ID
      - ディレクトリ階層
      - タグ
      - カテゴリ
      - タイトル
      - 作成者
      - 作成年月日
      - 更新年月日
      - 内容

  - JSONを返すAPI
  - 管理画面のページネーション

  ### フロントエンド
  * 変更をほぼ行わない静的な部分に関してはAPIで取得せずにvue書く
  * 記事部分はAPIから内容を取得する
  
# Laravel設定
  ###プロジェクト作成
  コマンドプロンプトもしくはvscodeターミナルにてプロジェクトルートのディレクトリにcdして以下のコードを実行

    php artisan laravel/laravel {project name} "6.x"
  
