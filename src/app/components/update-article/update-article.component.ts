import { Component, OnInit, Output, EventEmitter } from '@angular/core';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-update-article',
  templateUrl: './update-article.component.html',
  styleUrls: ['./update-article.component.css'],
})
export class UpdateArticleComponent implements OnInit {
  extrait: any;
  title: any;
  id: any;
  status: Boolean = false;
  error: any;

  constructor(private route: ActivatedRoute) {}

  ngOnInit(): void {
    this.id = this.route.snapshot.paramMap.get('id');
    console.log(this.id);
    fetch('http://localhost:8000/getArticle.php?id=' + this.id)
      .then(function (response) {
        return response.json();
      })
      .then((data) => {
        console.log(data);
        if (data.status === 'success') {
          this.extrait = data.article.extrait;
          this.title = data.article.title;
          this.status = true;
        } else {
          this.status = false;
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
    console.log(this.id);
    console.log(this.title);
    console.log(this.extrait);
    let newArticle = {
      extrait: this.extrait,
      tittle: this.title,
      id: this.id,
    };

    fetch('http://localhost:8000/updateArticle.php', {
      method: 'POST',
      body: JSON.stringify(newArticle),
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        console.log(data);
      });
  }
}
