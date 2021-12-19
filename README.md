## アプリケーション概要

自分で作った謎解き問題の投稿や、他の人が投稿した謎解き問題を解くことができるWebサイト

URL：https://fathomless-cove-42519.herokuapp.com

投稿や評価の確認をする際のサンプルアカウントです。

**サンプルアカウント１（投稿用）**
- ユーザーID：user1
- メールアドレス：user1@sample.com
- パスワード：sample.1

**サンプルアカウント２（評価用）**
- ユーザーID：user2
- メールアドレス：user2@sample.com
- パスワード：sample.2

謎タイトルが「屋台の謎」、「暗号の謎」、「迷路の謎」は、私が作成した謎です。<br>謎を解くときはログイン不要ですので、もしよろしければ解いてみてください。

## 背景

最近、謎解きがブームになっており、個人で謎を制作する人たちが気軽に謎を公開できればと思ったため作成しました。また、解くことが好きな人は様々な謎に触れることができ、楽しめると思ったためです。

## 開発環境・使用言語

- 開発環境：AWS（Cloud9）
- 使用言語：PHP（バージョン7.3.30），HTML，CSS，JavaScript


## 機能一覧

- 謎投稿機能（ログイン時のみマイページから可能）
<img src="https://raw.githubusercontent.com/wiki/taka7mz/Riddles_Site/images/post.jpeg" width="360px">

- マイページ機能
- 正解した謎の記録機能（ログイン状態で正解した他の人の謎を記録し、マイページに表示）
- 謎削除機能（自分が投稿した謎のみ、マイページに表示）
<img src="https://raw.githubusercontent.com/wiki/taka7mz/Riddles_Site/images/mypage.jpeg" width="360px">

- 解答，正誤判定機能（ログインなしでも可）
<img src="https://raw.githubusercontent.com/wiki/taka7mz/Riddles_Site/images/correct.jpeg" width="360px">
<img src="https://raw.githubusercontent.com/wiki/taka7mz/Riddles_Site/images/incorrect.jpeg" width="360px">

- 会員登録，ログイン機能
- Googleログイン機能
<img src="https://raw.githubusercontent.com/wiki/taka7mz/Riddles_Site/images/googlelog.jpeg" width="360px">

- 評価機能（コメント，星評価，ログイン時かつ他の人の謎のみ）
<img src="https://raw.githubusercontent.com/wiki/taka7mz/Riddles_Site/images/review.jpeg" width="360px">

- ランキング機能（星評価の平均値によるランキング）
<img src="https://raw.githubusercontent.com/wiki/taka7mz/Riddles_Site/images/home.jpeg" width="360px">


## 工夫したところ

 - Vueを用いた星評価の導入で、視覚的に評価が分かるようにし、トップページに上位5位のランキングを表示したことで、評価の高い謎にアクセスしやすくした点。
 - 正解，不正解，ヒントの表示をCSSを用いてポップアップ表示にしたため、ページの移動をすることなく表示されるようにした点。
 - ログイン時、ユーザーIDでもメールアドレスでもログインできるようにした点。
 - Googleログインを可能にし、本サイトの会員になりやすくした点。
 - 「入力項目のバリデーション」、「謎の投稿ボタンをマイページのみに設置する」、「一つの謎に対してユーザーは一度しかレビューをできないようにする」、「自分が投稿した謎にはレビューできない」など、バリデーションやアクセス制限を用いることでユーザーの誤動作を防ぐようにした点。
 - 画像保存場所にS3を用いたことで、容量を大きくした点。


