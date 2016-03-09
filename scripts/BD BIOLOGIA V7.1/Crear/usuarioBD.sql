create user 'administrador'@'%';
set password for 'administrador'@'%' = password('biologia');


grant select on biologia.Usuario to 'administrador'@'%';
grant select on biologia.Asignatura to 'administrador'@'%';
grant select on biologia.Guia to 'administrador'@'%';
grant select on biologia.UsuarioAsignatura to 'administrador'@'%';
grant select on biologia.Repositorio to 'administrador'@'%';
grant select on biologia.Pregunta to 'administrador'@'%';
grant select on biologia.SeleccionMultiple to 'administrador'@'%';
grant select on biologia.Contenido to 'administrador'@'%';
grant select on biologia.Respuesta to 'administrador'@'%';

grant insert on biologia.Usuario to 'administrador'@'%';
grant insert on biologia.Asignatura to 'administrador'@'%';
grant insert on biologia.Guia to 'administrador'@'%';
grant insert on biologia.UsuarioAsignatura to 'administrador'@'%';
grant insert on biologia.Repositorio to 'administrador'@'%';
grant insert on biologia.Pregunta to 'administrador'@'%';
grant insert on biologia.SeleccionMultiple to 'administrador'@'%';
grant insert on biologia.Contenido to 'administrador'@'%';
grant insert on biologia.Respuesta to 'administrador'@'%';

grant update on biologia.Usuario to 'administrador'@'%';
grant update on biologia.Asignatura to 'administrador'@'%';
grant update on biologia.Guia to 'administrador'@'%';
grant update on biologia.UsuarioAsignatura to 'administrador'@'%';
grant update on biologia.Repositorio to 'administrador'@'%';
grant update on biologia.Pregunta to 'administrador'@'%';
grant update on biologia.SeleccionMultiple to 'administrador'@'%';
grant update on biologia.Contenido to 'administrador'@'%';
grant update on biologia.Respuesta to 'administrador'@'%';

grant delete on biologia.Usuario to 'administrador'@'%';
grant delete on biologia.Asignatura to 'administrador'@'%';
grant delete on biologia.Guia to 'administrador'@'%';
grant delete on biologia.UsuarioAsignatura to 'administrador'@'%';
grant delete on biologia.Repositorio to 'administrador'@'%';
grant delete on biologia.Pregunta to 'administrador'@'%';
grant delete on biologia.SeleccionMultiple to 'administrador'@'%';
grant delete on biologia.Contenido to 'administrador'@'%';
grant delete on biologia.Respuesta to 'administrador'@'%';