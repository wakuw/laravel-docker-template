# Laravel Lesson レビュー①

## Todo一覧機能

### Todoモデルのallメソッドで実行しているSQLは何か
select * from todo

### Todoモデルのallメソッドの返り値は何か
Illuminate\Database\Eloquent\Collection
 #items: array:2
  0 => App\Todo
  1 => App\Todo

### 配列の代わりにCollectionクラスを使用するメリットは
・配列データの操作が簡単
・コードの可読性と保守性が上がる

### view関数の第1・第2引数の指定と何をしているか
第1引数は「画面に表示させたいファイル」
第2引数は「使いたいデータ（連想配列）」

### index.blade.phpの$todos・$todoに代入されているものは何か
$todosはtodoクラスをインスタンス化させたもの
$todoは$todosでインスタンス化したものからDBのレコードのデータ全件

## Todo作成機能

### Requestクラスのallメソッドは何をしているか
フォームから送られた値を一括で取得している。

### fillメソッドは何をしているか
todoインスタンスの各プロパティにallメソッドで一括取得した値を一括で代入している。

### $fillableは何のために設定しているか
fillメソッドで一括代入できるプロパティを指定している。

### saveメソッドで実行しているSQLは何か
insert into todo (content) value (入力された値)

### redirect()->route()は何をしているか
todoの一覧画面へリダイレクトさせている。

## その他

### テーブル構成をマイグレーションファイルで管理するメリット
・SQLを知らなくても、PHPコードでテーブル操作ができるため学習コストが不要
・マイグレーションファイルをGitで共有することで、開発者全員が同じテーブルを作成することができる

### マイグレーションファイルのup()、down()は何のコマンドを実行した時に呼び出されるのか
artisanコマンド

### Seederクラスの役割は何か
レコードの作成を担う。

### route関数の引数・返り値・使用するメリット
引数は移動したいルート名（ファイル名）
返り値はURL
メリットは、「短い記載で済む」「パスの修正が簡単」

### @extends・@section・@yieldの関係性とbladeを分割するメリット
@extendsは、継承先のblade内で@extends()を記載することで、親bladeのファイルを指定している。
@sectionは、継承先のblade内で@section()から@endsectionで囲んだ中の行の部分を、親bladeに記載されている@yield()の箇所へ引数として渡す。
@yeildは、親blade内に@sectionから渡され引数を受け取りたい箇所へ記載し、継承先のbladeと紐づける。

分割するメリットは、各bladeで共通する記述が必要なときや、共通する記述の修正が必要な時、
都度各bladeを編集しなくても共通部分だけを別ファイルにまとめ、再利用しやすくできる。

### @csrfは何のための記述か
CSRF対策のためのトークンが含まれたinputタグを生成するための記述。

### {{ }}とは何の省略系か
<?php echo ?>の省略形



## 追加課題

### public function store(Request $request)代入されている値＋データ型調べる→object型ならnamespaceとクラス名


### 「return view('todo.index', ['todos' => $todos]);」第一引数をtest.indexにするには？

### 「return view('todo.index', ['todos' => $todos]);」変数名「okabe」で一覧表示