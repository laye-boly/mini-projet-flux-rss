import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-article-detail',
  templateUrl: './article-detail.component.html',
  styleUrls: ['./article-detail.component.css'],
})
export class ArticleDetailComponent implements OnInit {
  extrait: any;
  title: any;
  image: any;
  constructor(private route: ActivatedRoute) {}

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    fetch('http://localhost:8000/getArticle.php?id=' + id)
      .then(function (response) {
        return response.json();
      })
      .then((data) => {
        console.log(data);
        this.extrait = data.article.extrait;
        this.title = data.article.title;
        this.image = data.article.img;
      });
  }
}
