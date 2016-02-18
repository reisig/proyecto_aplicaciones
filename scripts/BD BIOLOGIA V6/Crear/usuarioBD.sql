create user 'administrador'@'%';
set password for 'administrador'@'%' = password('biologia');


grant select on biologia.usuarios to 'administrador'@'%';
grant select on biologia.asignatura to 'administrador'@'%';
grant select on biologia.guias to 'administrador'@'%';
grant select on biologia.usuario_asignatura to 'administrador'@'%';
grant select on biologia.repositorio to 'administrador'@'%';
grant select on biologia.preguntas to 'administrador'@'%';
grant select on biologia.seleccion_multiple to 'administrador'@'%';
grant select on biologia.respuesta to 'administrador'@'%';

grant insert on biologia.usuarios to 'administrador'@'%';
grant insert on biologia.asignatura to 'administrador'@'%';
grant insert on biologia.guias to 'administrador'@'%';
grant insert on biologia.usuario_asignatura to 'administrador'@'%';
grant insert on biologia.repositorio to 'administrador'@'%';
grant insert on biologia.preguntas to 'administrador'@'%';
grant insert on biologia.seleccion_multiple to 'administrador'@'%';
grant insert on biologia.respuesta to 'administrador'@'%';


grant update on biologia.usuarios to 'administrador'@'%';
grant update on biologia.asignatura to 'administrador'@'%';
grant update on biologia.guias to 'administrador'@'%';
grant update on biologia.usuario_asignatura to 'administrador'@'%';
grant update on biologia.repositorio to 'administrador'@'%';
grant update on biologia.preguntas to 'administrador'@'%';
grant update on biologia.seleccion_multiple to 'administrador'@'%';
grant update on biologia.respuesta to 'administrador'@'%';
