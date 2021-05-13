# ローカル環境
・PHP 7.4.10<br>
・Laravel 6.x<br>
・NodeJs<br>
・NuxtJs<br>
・PostgreSQL 12.6<br>
・Git（検討中）<br>

# デプロイ
・heroku Hobby PostgreSQL<br>
選ばれるのは、heroku。<br>

# 技術選定
バックエンド<br>
・PHP <br>
  特になし。Laravel 6.xが動けば良いため7.2以上のバージョンであれば何でもよかったため、レンタルサーバーでも多く使用されている7.4を使用。<br>
  <br>
・Laravel 6.x<br>
  最新版は8.x（2021/5現在）だがLTS版が6.xのため、6.xを採用。8.xのsunctom認証やJetstreamは機会があれば別途学習する。<br>
  <br>
・PostgreSQL 12.6<br>
  最新版は13.x（2021/5現在）だが、デプロイ先のherokuのPostgreSQLが12.x（2021/5現在）となっているため12.6をインストールする。<br>
  <br>
フロントエンド<br>
・NuxtJS<br>
  フロント部分はSSRで行いたかったためNuxtを使用。<br>
  <br>
# 選定背景
  バックエンド部は各CMSを利用する手段も視野にあったが、今回はLaravelでのSQL操作を通してデータベースへのアクセスも同時に学習したく、かつ期間内の完成を目指したかったためLaravelを採用。<br>
LaravelおよびNuxtは同一レポジトリではあるものの、LaravelはLaravel/uiを用いた管理画面、フロントはフロントで分けて開発を行い、Laravelではブログポストなどデータベースの各データを管理画面で編集しJSON形式で出力するAPIとして活用する。これにより、フロントエンドのレポジトリやフレームワークに寄らない開発を学習する。<br>
  管理画面はLaravel/ui vueで開発する。管理画面は想定されるページ数に限りがあり、またSEO上、構造上ページが分かれていなくても問題なく画面自体も簡素でいいためSPAでの開発を行う。あと、うごきがかっこいいから。<br>
  フロント部はSSRで作成する。SPAでのJSON-LDによる構造化や正規表現など欠点を克服し、SEOを行う面で効果的な開発を目指す。あと、うごきがかっこいいから。<br>
  サーバーはheroku,Netlifyやfirebase,AWSと色々検討した結果、とりあえず学習用の個人利用でランニングコストもかからないherokuにする。万が一、良い意味でバズった場合はアップグレードも視野に入れようかと思うし、フロント部だけ分離してレンタルサーバーで運用しちゃう手もある。<br>
  <br>
 Git ←→ GitHub ←→ heroku server { NuxtJS ←→ Laravel(API) ←→　Laravel/ui vue (管理画面) }　←→　PostgreSQL<br>
 <br>
# 環境構築
　ここより公式リファレンスや他記事の方が詳しく載っているため内容は割愛<br>
■ PHP、Apache<br>
  ・XAMPPをインストールしローカル環境にPHPとApacheの環境を構築する。<br>
  ・初期設定ではPHP.iniにXdebugが無くextension = PDO_pg-sqlがコメントアウトしていたため有効にする。<br>
  <br>
■ PostgreSQL<br>
  ・公式からダウンロードしてインストールし、システム環境変数にPathを設定する。<br>
  テスト環境は<br>
    port:5432(初期設定)<br>
    user:user<br>
    password:pass<br>
  で構築<br>
  <br>
■ VisualStudioCode<br>
  ・Html、Css、Javascript学習用に使用していたため、そのまま使用。<br>
  ・各システムの拡張機能をインストールしておく。<br>
  <br>
■ NodeJS<br>
  ・公式から最新版をインストールしとく<br>
  <br>
■ Git<br>
  検討中<br>
<br>
# 設計
  バックエンド<br>
  ・ユーザー認証（管理ユーザーと編集ユーザーで分ける）<br>
     WordpressのDB構造をある程度パクる<br>
      ・ID<br>
      ・権限<br>
      ・名前<br>
      ・mail<br>
      ・登録年月日<br>
    <br>
  ・ユーザー登録（管理ユーザーのみ）<br>
    認証と同じ<br>
  <br>
  ・記事作成（全ユーザー）<br>
    Wordpressをパクる<br>
      ・ID<br>
      ・ディレクトリ階層<br>
      ・タグ<br>
      ・カテゴリ<br>
      ・タイトル<br>
      ・作成者<br>
      ・作成年月日<br>
      ・更新年月日<br>
      ・内容<br>
      <br>
  ・JSONを返すAPI<br>
  ・管理画面のページネーション<br>
  <br>
  フロントエンド<br>
  ・変更をほぼ行わない静的な部分に関してはAPIで取得せずにvue書く<br>
  ・記事部分はAPIから内容を取得する<br>
  
# Laravel設定
  php artisan laravel/ui 
