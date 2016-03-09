/*PREGUNTAS*/

insert into Pregunta values(1,'Subir foto','FOTO');

insert into Pregunta values(2,'Subir foto','FOTO');

insert into Pregunta values(3,'Subir dibujo','DIBUJO');

insert into Pregunta values(4,'Subir dibujo','DIBUJO');

insert into Pregunta values(5,'Material usado','MULTIPLE');
	insert into SeleccionMultiple values(5,'Epidermis inferior de hoja','LISTA');
	insert into SeleccionMultiple values(5,'Epidermis inferior de catafilo de cebolla','LISTA');
	insert into SeleccionMultiple values(5,'Aparato de Golgi en epidídimo de rata','LISTA');
	insert into SeleccionMultiple values(5,'Ovocito en ovario de macha (M. donacium)','LISTA');
	insert into SeleccionMultiple values(5,'Frotis de sangre humana','LISTA');
	insert into SeleccionMultiple values(5,'Frotis de sangre de ave','LISTA');
	insert into SeleccionMultiple values(5,'Frotis de sangre de tiburón','LISTA');
	insert into SeleccionMultiple values(5,'Hepatocitos en hígado de rata','LISTA');
	insert into SeleccionMultiple values(5,'Mitosis en cebolla (A. cepa)','LISTA');
	insert into SeleccionMultiple values(5,'Médula espinal en rata','LISTA');
	insert into SeleccionMultiple values(5,'Corte de riñón','LISTA');
	insert into SeleccionMultiple values(5,'Músculo estriado esquelético','LISTA');
	insert into SeleccionMultiple values(5,'Intestino delgado','LISTA');
	insert into SeleccionMultiple values(5,'Ovario de rata','LISTA');
	insert into SeleccionMultiple values(5,'Testículo de rata','LISTA');
	insert into SeleccionMultiple values(5,'Otro','LISTA');
		
insert into Pregunta values(6,'Tipo de preparación','MULTIPLE');
	insert into SeleccionMultiple values(6,'Alfresco','RADIO');
	insert into SeleccionMultiple values(6,'Permanente','RADIO');

insert into Pregunta values(7,'Teñida con','MULTIPLE');
	insert into SeleccionMultiple values(7,'Sin tinción','LISTA');
	insert into SeleccionMultiple values(7,'Hematoxilina-eosina','LISTA');
	insert into SeleccionMultiple values(7,'Feulgen + Geimsa','LISTA');
	insert into SeleccionMultiple values(7,'Feulgen + Fast Green','LISTA');
	insert into SeleccionMultiple values(7,'May Grunwald-Geimsa','LISTA');
	insert into SeleccionMultiple values(7,'Geimsa','LISTA');
	insert into SeleccionMultiple values(7,'Violeta cristal','LISTA');
	insert into SeleccionMultiple values(7,'Carmín acético','LISTA');
	insert into SeleccionMultiple values(7,'PAS','LISTA');
	insert into SeleccionMultiple values(7,'Tinción argéntica','LISTA');
	insert into SeleccionMultiple values(7,'Azul de metileno','LISTA');
	insert into SeleccionMultiple values(7,'Lugol','LISTA');
	insert into SeleccionMultiple values(7,'Tinción argéntica','LISTA');
	insert into SeleccionMultiple values(7,'Orceína','LISTA');

insert into Pregunta values(8,'Forma celular','MULTIPLE');
	insert into SeleccionMultiple values(8,'Esférica','LISTA');
	insert into SeleccionMultiple values(8,'Ovoidal','LISTA');
	insert into SeleccionMultiple values(8,'Elíptica','LISTA');
	insert into SeleccionMultiple values(8,'Cúbica','LISTA');
	insert into SeleccionMultiple values(8,'Paralelepípedo recto','LISTA');
	insert into SeleccionMultiple values(8,'Cilíndrica','LISTA');
	insert into SeleccionMultiple values(8,'Otra','LISTA');

insert into Pregunta values(9,'Dimensiones aproximadas','TITULO');
insert into Pregunta values(10,'Largo o diámetro mayor','TEXTO');
insert into Pregunta values(11,'Ancho o diámentro menor','TEXTO');

insert into Pregunta values(12,'Relaciones entre células','MULTIPLE');
	insert into SeleccionMultiple values(12,'Aisladas','RADIO');
	insert into SeleccionMultiple values(12,'En cadena','RADIO');
	insert into SeleccionMultiple values(12,'Constituyendo membrana','RADIO');
	
insert into Pregunta values(13,'Núcleo y Nucléolo','TITULO');
insert into Pregunta values(14,'Presenta núcleo','MULTIPLE');
	insert into SeleccionMultiple values(14,'Si','RADIO');
	insert into SeleccionMultiple values(14,'No','RADIO');
	
insert into Pregunta values(15,'Forma núcleo','MULTIPLE');
	insert into SeleccionMultiple values(15,'Esférico','RADIO');
	insert into SeleccionMultiple values(15,'Ovoidal','RADIO');
	insert into SeleccionMultiple values(15,'Lobulado','RADIO');
	insert into SeleccionMultiple values(15,'Ninguna','RADIO');

insert into Pregunta values(16,'Número por célula','MULTIPLE');
	insert into SeleccionMultiple values(16,'1','RADIO');
	insert into SeleccionMultiple values(16,'2','RADIO');
	insert into SeleccionMultiple values(16,'3','RADIO');
	insert into SeleccionMultiple values(16,'Otro','RADIO');

insert into Pregunta values(17,'Posición','MULTIPLE');
	insert into SeleccionMultiple values(17,'Central','RADIO');
	insert into SeleccionMultiple values(17,'Periférica','RADIO');

insert into Pregunta values(18,'Presenta nucléolo','MULTIPLE');
	insert into SeleccionMultiple values(18,'Si','RADIO');
	insert into SeleccionMultiple values(18,'No','RADIO');
	
insert into Pregunta values(19,'Número por núcleo','MULTIPLE');
	insert into SeleccionMultiple values(19,'1','RADIO');
	insert into SeleccionMultiple values(19,'2','RADIO');
	insert into SeleccionMultiple values(19,'3','RADIO');
	insert into SeleccionMultiple values(19,'Otro','RADIO');
	
	
insert into Pregunta values(20,'Citoplasma','TITULO');
insert into Pregunta values(21,'Presencia de estructuras diferenciables','MULTIPLE');
	insert into SeleccionMultiple values(21,'Si','RADIO');
	insert into SeleccionMultiple values(21,'No','RADIO');

insert into Pregunta values(22,'Tipo','MULTIPLE');
	insert into SeleccionMultiple values(22,'Granular','RADIO');
	insert into SeleccionMultiple values(22,'Fibrilar','RADIO');
	insert into SeleccionMultiple values(22,'Globular','RADIO');
	insert into SeleccionMultiple values(22,'Ninguna','RADIO');
	
insert into Pregunta values(23,'Nombre de la estructura','TEXTO');
insert into Pregunta values(24,'Número relativo por célula','MULTIPLE');
	insert into SeleccionMultiple values(24,'Abundante','RADIO');
	insert into SeleccionMultiple values(24,'Regular','RADIO');
	insert into SeleccionMultiple values(24,'Escaso','RADIO');
   

insert into Pregunta values(25,'Posición y distribución preferente','MULTIPLE');
	insert into SeleccionMultiple values(25,'Homogénea','RADIO');
	insert into SeleccionMultiple values(25,'Periférica','RADIO');
	insert into SeleccionMultiple values(25,'Peri-nuclear','RADIO');
	
insert into Pregunta values(26,'Observaciones','AREA');	

insert into Pregunta values(27,'Pared celular','MULTIPLE');
	insert into SeleccionMultiple values(27,'Presente','RADIO');
	insert into SeleccionMultiple values(27,'Ausente','RADIO');

insert into Pregunta values(28,'Otras observaciones','AREA');	
	
