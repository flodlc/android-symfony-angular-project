import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ActorAddComponent } from './actor-add.component';

describe('ActorAddComponent', () => {
  let component: ActorAddComponent;
  let fixture: ComponentFixture<ActorAddComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ActorAddComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ActorAddComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
