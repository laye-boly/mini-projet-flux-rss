import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { Article } from '../../Article';

@Component({
  selector: 'app-article-item',
  templateUrl: './article-item.component.html',
  styleUrls: ['./article-item.component.css'],
})
export class ArticleItemComponent implements OnInit {
  @Input() article: any;
  @Output() onDeleteTask: EventEmitter<Article> = new EventEmitter();
  @Output() onToggleReminder: EventEmitter<Article> = new EventEmitter();
  constructor() {}

  ngOnInit(): void {}

  onUpdate(article: Article) {
    this.onDeleteTask.emit(article);
  }
}
