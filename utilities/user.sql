create user 'radio-user'@'%' identified by 'radio';
grant select, insert, update, delete, lock tables on `radiologia`.* to 'radio-user'@'%';