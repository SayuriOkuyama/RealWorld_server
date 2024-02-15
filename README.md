# このリポジトリについて

内定直結型エンジニア実習「アプレンティス」の２期生として、AWS の学習をしています。 本リポジトリは、AWS 学習の課題として提出するためのものです。

## AWS で Laravel API をデプロイしました。

https://apprentice.my-raga-bhakti.com/

掲示板 Web アプリケーションのバックエンド API として、MySQL と通信し、レスポンスを返します。

- GET メソッド：投稿記事の全件取得

  エンドポイント：`https://apprentice.my-raga-bhakti.com/api/articles/`

  ```json
  {
      "current_page": 1,
      "data": [
          {
              "id": 66,
              "title": "とけるよ。だからふり返かえってそれはたしは、少した。右手の渚なぎさにひらきました。けれどもいっしたくさんあわれ、電話で故障。",
              "about": "出ました。二人でいました。そこに鳥捕とりがまた鳥を捕とり、リトル、スターをうたったように、ぺか消きえるらしい写真しゃの皺曲しゅうやうや地球ちきゅうのだ。変へんけいのはじめましたのですかなしみると白いすすけするにわから、「この辺。",
              "content": "ったなくなっていました。「こどもするにしてそれはたした。そこでなくなって、またしもまた忙いそいでそっていらって立っていました。ジョバンニは、波なみだを半分出してちらの影かげんとうこの深ふかんでこらを押おさえきました。青年はさよならんです。そらを見ました。「さあ、もうみんな女の子や青年が祈いのですから飛とびらを仰あおぎました。ええ、そのときはまたたんがするかどうのことありましたもんでいくらい前の天気輪てんきょくを求もとのした。すこしから水へ落おちるまの川の微光びこうも見えること。",
              "user_id": 28,
              "created_at": "2024-02-14T20:34:03.000000Z",
              "updated_at": "February 14th",
              "tags": [],
              "user": {
                  "id": 28,
                  "name": "斉藤 さゆり",
                  "email": "miyazawa.naoko@example.com",
                  "email_verified_at": "2024-02-14T20:34:02.000000Z",
                  "created_at": "2024-02-14T20:34:02.000000Z",
                  "updated_at": "2024-02-14T20:34:02.000000Z"
              }
          },

  ...
  ```

- POST メソッド：記事の新規投稿

  エンドポイント：`https://apprentice.my-raga-bhakti.com/api/articles/`

  リクエスト形式

  ```json
  {
    "article": {
      "title": "新しい投稿",
      "body": "テキストテキストテキストテキスト",
      "description": "概要",
      "tagList": ["タグ"]
    }
  }
  ```

- PUT メソッド：記事の更新

  エンドポイント：`https://apprentice.my-raga-bhakti.com/api/articles/{id}`

  リクエスト形式

  ```json
  {
    "article": {
      "title": "新しい投稿",
      "body": "テキストテキストテキストテキスト",
      "description": "概要"
    }
  }
  ```

- DELETE メソッド：記事の削除

  エンドポイント：`https://apprentice.my-raga-bhakti.com/api/articles/{id}`
