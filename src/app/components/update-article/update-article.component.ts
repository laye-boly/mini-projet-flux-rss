import { Component, OnInit, Output, EventEmitter } from '@angular/core';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-update-article',
  templateUrl: './update-article.component.html',
  styleUrls: ['./update-article.component.css'],
})
export class UpdateArticleComponent implements OnInit {
  extrait: any;
  title: any;
  id: any;
  status: string = '';
  error: any;

  constructor(private route: ActivatedRoute, private http: HttpClient) {}

  ngOnInit(): void {
    this.id = this.route.snapshot.paramMap.get('id');
    fetch('http://localhost:8000/getArticle.php?id=' + this.id)
      .then(function (response) {
        return response.json();
      })
      .then((data) => {
        console.log(data);
        if (data.status === 'success') {
          this.extrait = data.article.extrait;
          this.title = data.article.title;
        } else {
          this.error = data.message;
        }
      });
  }

  onSubmit() {
    console.log('me clicked !');
    if (!this.extrait.trim()) {
      alert('Ce champ est obligatoire');
      return;
    }
    if (!this.title.trim()) {
      alert('Ce champ est obligatoire');
      return;
    }

    var data = new FormData();
    data.append('title', this.title);
    data.append('extrait', this.extrait);
    data.append('id', this.id);
    fetch('http://localhost:8000/updateArticle.php', {
      method: 'POST',
      body: data,
    })
      .then(function (response) {
        return response.json();
      })
      .then((data) => {
        console.log(data);
        if (data.status === 'success') {
          this.extrait = data.extrait;
          this.title = data.title;
          this.id = data.id;
          this.status = 'success';
        } else {
          this.error = data.message;
          this.status = 'error';
        }
      })
      .catch((data) => {
        console.log(data);
        this.error = data.message;
        this.status = 'error';
      });
  }
}
