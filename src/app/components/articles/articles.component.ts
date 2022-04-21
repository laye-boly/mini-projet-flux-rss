import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-articles',
  templateUrl: './articles.component.html',
  styleUrls: ['./articles.component.css'],
})
export class ArticlesComponent implements OnInit {
  articles: any;
  previous: number = 0;
  next: number = 2;
  status: Boolean = true;
  error: any;

  constructor() {}

  ngOnInit(): void {
    this.getArticles();
    this.previous = 0;
    this.next = 2;
  }

  getPreviousArticles() {
    this.getArticles(this.previous);
    this.previous--;
    this.next--;
  }

  getNextArticles() {
    this.getArticles(this.next);
    this.previous++;
    this.next++;
  }

  getArticles(page = 1) {
    let url = 'http://localhost:8000/getArticles.php';
    fetch(url + '?page=' + page)
      .then(function (response) {
        return response.json();
      })
      .then((data) => {
        console.log(data);
        if (data.status === 'success') {
          this.articles = data.articles;
        } else {
          this.status = false;
          this.error = data.message;
        }
      });
  }

  updateArticle(article: any) {
    fetch('http://localhost:8000/updateArticles.php', {
      method: 'post',
      body: JSON.stringify(article),
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        console.log(data);
      });
  }
}
