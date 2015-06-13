--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.6
-- Dumped by pg_dump version 9.3.6
-- Started on 2015-06-13 15:25:22

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- TOC entry 2039 (class 0 OID 33241)
-- Dependencies: 171
-- Data for Name: categoria; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY categoria (nomec, nomesuperc) FROM stdin;
informatica	\N
basi di dati	informatica
grafica	informatica
giardinaggio	\N
fiori	giardinaggio
alberi	giardinaggio
fiori da esterni	fiori
fiori da interni	fiori
opengl	grafica
architettura	informatica
arduino	architettura
fantasy	\N
letteratura	fantasy
giochi di ruolo	fantasy
sport	\N
nuoto	sport
atletica	sport
calcio	sport
cucina	\N
giapponese	cucina
sushi	giapponese
italiana	cucina
\.


--
-- TOC entry 2042 (class 0 OID 33269)
-- Dependencies: 174
-- Data for Name: domandaperta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY domandaperta (idd, titolo, datad, testo, imgtesto, chiusa, nome, imgurl) FROM stdin;
6	D and D	2015-06-12 22:51:42.408	Come posso potenziare le statistiche del mio personaggio?	\N	f	mik	\N
7	Erbacce nel giardino	2015-06-12 22:53:08.388	Non capisco come posso fare velocemente per toglierle, non riesco proprio. Avete dei consigli?	\N	f	ofelia	\N
8	Consiglio per una lettura	2015-06-12 22:54:39.864	Ciao! Che libro mi consigliate di iniziare a leggere? :)	\N	f	teo	\N
10	Fiori resistenti in casa	2015-06-12 22:56:38.325	Ho regalato delle begonie a mia madre, ma si è subito seccata, altre da consigliarmi? :(	\N	f	gelsomino	\N
13	Libro per studiare programmazione	2015-06-12 23:24:27.364	Ehi! Che libro mi consigliate per imparare la programmazione in generale? :)	\N	f	teo	\N
15	Sito di cucina	2015-06-12 23:27:09.457	Avreste un buon sito di cucina da consigliarmi?	\N	f	gregory	\N
16	Panchina da esterno	2015-06-12 23:28:47.584	Sapreste per caso dove posso acquistare una panchina per giardini da esterno? Grazie mille!	\N	f	jack	\N
17	Consiglio corsi a scelta	2015-06-12 23:29:24.473	Mi consigliate di fare sicurezza o algoritmi?	\N	f	matte	\N
18	Tiglio o quercia	2015-06-12 23:33:32.559	Ho trovato questa foglia dai margini frastagliati e non capisco di che pianta sia. Mi date una mano?	\N	f	oite	\N
2	Problemi con php	2015-06-12 22:49:46.522	Come posso interrogare un database sql?	\N	t	oite	\N
11	Sport migliore per iniziare	2015-06-12 23:19:47.403	Potreste suggeririmi uno sport adatto per iniziare?	\N	t	enrico	\N
12	Sql problema	2015-06-12 23:22:27.777	Ciao! Ho un problema, non capisco a cosa serva il "distinct". Grazie in anticipo per le risposte! :)	\N	t	oite	\N
20	Blender e Maya: dilemma	2015-06-12 23:34:33.192	Quale credete che sia il codice sorgente maggiormente leggibile tra i due?	\N	t	matte	\N
1	OpenGl?	2015-06-12 22:49:06.58	Che libreria usare per studiare opengl?	Un esempio Opengl	f	alice	http://www.codeproject.com/KB/openGL/OpenGLTestFrmwk/GLDemoApp.png
\.


--
-- TOC entry 2064 (class 0 OID 0)
-- Dependencies: 173
-- Name: domandaperta_idd_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('domandaperta_idd_seq', 26, true);


--
-- TOC entry 2040 (class 0 OID 33252)
-- Dependencies: 172
-- Data for Name: preferenza; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY preferenza (nome, nomec) FROM stdin;
alice	fiori
alice	grafica
oite	alberi
oite	basi di dati
mik	fantasy
mik	architettura
mik	arduino
gelsomino	fiori
gelsomino	giardinaggio
gelsomino	cucina
guido	informatica
guido	sport
morgana	letteratura
morgana	fantasy
matte	informatica
matte	grafica
matte	sport
matte	calcio
fede	letteratura
gregory	cucina
enrico	sport
jack	giardinaggio
jack	calcio
fra	letteratura
petunia	giardinaggio
teo	informatica
teo	letteratura
ofelia	basi di dati
matte	basi di dati
guido	grafica
enrico	fantasy
fra	fiori
alice	informatica
alice	giardinaggio
gennaro	grafica
gennaro	opengl
gennaro	giardinaggio
gennaro	fiori
gennaro	fiori da esterni
gennaro	fiori da interni
gennaro	alberi
\.


--
-- TOC entry 2050 (class 0 OID 33361)
-- Dependencies: 182
-- Data for Name: rispostaperta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rispostaperta (idr, anonimo, datar, testorisp, nome, idd) FROM stdin;
1	t	2015-06-12 23:44:18.542	Ma che cosa stupida	guido	1
2	f	2015-06-12 23:44:48.046	Magari usa Glut :)	matte	1
3	f	2015-06-12 23:45:54.958	Prova seguire qualche tutorial :)	matte	2
4	f	2015-06-12 23:46:27.178	Ho trovato la soluzione :) Grazie matte!	oite	2
5	f	2015-06-12 23:51:37.132	Fai la quest del castello nero per ricevere il bonus ;)	morgana	6
6	t	2015-06-12 23:52:02.222	Eh con tanta tanta pazienza, mi spiace :(	enrico	6
7	t	2015-06-12 23:55:38.448	Prova con del sale :P	gelsomino	7
8	f	2015-06-12 23:56:00.535	Devi mettere dei sassi intorno alle piante che vuoi proteggere	fra	7
9	f	2015-06-12 23:57:01.426	Signore degli Anelli! :)	fede	8
10	f	2015-06-12 23:57:25.474	Le cronache del mondo disco, divertimento assicurato!	morgana	8
11	f	2015-06-12 23:58:05.242	Mmmm di recente carino i piccoli orrori della via dei lampioni	fra	8
12	f	2015-06-13 00:01:48.931	Prova con una pianta rampicante	gelsomino	10
13	f	2015-06-13 00:02:29.319	Mmm non saprei, rivolgiti a un vivaio :(	alice	10
14	f	2015-06-13 00:03:48.711	Nuoto al 100% fidati	guido	11
15	f	2015-06-13 00:04:17.787	Vai con l'atletica che ti diverti ;)	matte	11
16	f	2015-06-13 00:05:55.19	Alla fine ho scelto nuoto :D	enrico	11
17	f	2015-06-13 00:06:24.135	Semplicmente ti toglie le tuple uguali :)	matte	12
18	f	2015-06-13 00:07:00.702	grazie, risolto!	oite	12
19	f	2015-06-13 00:07:46.317	Ti conviene seguire dei tutorial online	alice	13
21	f	2015-06-13 00:08:13.772	Mmm si , anche io propongo dei tutorial online	matte	13
22	f	2015-06-13 00:08:43.711	ok, ma potreste dirmi un titolo per favore?	teo	13
23	f	2015-06-13 00:09:51.694	prova qui : www.ricettefacili.it	oite	15
24	t	2015-06-13 00:10:53.462	prova in libreria con un buon libro	gelsomino	15
25	f	2015-06-13 00:13:40.367	guarda il sito di giardini e giardino l'ho trovato qui la mia panchina :)	petunia	16
27	f	2015-06-13 00:14:02.647	dovresti guardare su amazon per me	gelsomino	16
28	f	2015-06-13 00:14:24.965	mah a volte fanno delle buone offerte in arredamento.com	jack	16
29	f	2015-06-13 00:15:43.524	eh dipende da cosa vuoi fare, algoritmi secondo me copre tante cose importanti	alice	17
30	f	2015-06-13 00:16:05.915	algoritmi per me e' davvero inutile, lascialo stare	teo	17
31	f	2015-06-13 00:16:35.283	non sono d'accordo con  teo affatto, ribadisco sia meglio algoritmi	alice	17
32	f	2015-06-13 00:17:11.171	ok ok, tranquilli ho ancora tempo per decidere, grazie dell'interessamento!	matte	17
36	f	2015-06-13 00:18:59.086	direi che un tiglio e' molto piu profumato	gelsomino	18
37	f	2015-06-13 00:20:02.489	la quercia fa in assoluto piu' ombra, dipende dalle tue esigenze	petunia	18
38	f	2015-06-13 00:21:17.689	Blender! Di Maya non hai il codice sorgente XD proprietario :)	alice	20
41	f	2015-06-13 00:21:32.876	Vero, grazie mille!	matte	20
42	t	2015-06-13 13:17:50.552	Scegli liberamente senza problemi :)	alice	17
\.


--
-- TOC entry 2065 (class 0 OID 0)
-- Dependencies: 181
-- Name: rispostaperta_idr_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('rispostaperta_idr_seq', 42, true);


--
-- TOC entry 2048 (class 0 OID 33337)
-- Dependencies: 180
-- Data for Name: rispostapredefinita; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rispostapredefinita (idr, anonimo, datar, testorisp, nome, idd) FROM stdin;
2	f	2015-06-13 12:15:16.445	C	matte	3
1	f	2015-06-13 12:10:37.437	Cpp	alice	3
3	f	2015-06-13 12:17:43.579	Cpp	guido	3
\.


--
-- TOC entry 2066 (class 0 OID 0)
-- Dependencies: 179
-- Name: rispostapredefinita_idr_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('rispostapredefinita_idr_seq', 3, true);


--
-- TOC entry 2044 (class 0 OID 33288)
-- Dependencies: 176
-- Data for Name: sondaggio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sondaggio (idd, titolo, datad, testo, imgtesto, chiusa, nome, imgurl) FROM stdin;
1	Il vostro piatto preferito	2015-06-13 00:29:50.303	<br><br><input type=radio name=sonda value=pasta required>pasta<br><input type=radio name=sonda value=pizza required>pizza<br><input type=radio name=sonda value=carne required>carne<br>	\N	f	oite	\N
4	Preferenza sport	2015-06-13 11:57:17.969	<br><br><input type=radio name=sonda value=Calcio required>Calcio<br><input type=radio name=sonda value=Nuoto required>Nuoto<br><input type=radio name=sonda value=Atletica required>Atletica<br>	\N	f	matte	\N
5	Che fiori vi piacciono	2015-06-13 12:10:15.146	<br><br><input type=radio name=sonda value=rose required>rose<br><input type=radio name=sonda value=narcisi required>narcisi<br><input type=radio name=sonda value=gelsomini required>gelsomini<br><input type=radio name=sonda value=garofano required>garofano<br>	\N	f	alice	\N
3	Quale linguaggio di programmazione preferite?	2015-06-13 11:54:39.175	<br><br><input type=radio name=sonda value=C required>C<br><input type=radio name=sonda value=Cpp required>Cpp<br><input type=radio name=sonda value=Python required>Python<br><input type=radio name=sonda value=Java required>Java<br>	\N	f	matte	\N
6	Piante da giardino preferite	2015-06-13 12:39:09.048	<br><br><input type=radio name=sonda value=garofano required>garofano<br><input type=radio name=sonda value=margherita required>margherita<br><input type=radio name=sonda value=acero required>acero<br><input type=radio name=sonda value=genziana required>genziana<br>	un esempio di pianta preferita	f	alice	http://yournaperville.com/wp-content/uploads/2013/04/flowers-shops-in-naperville.jpg
7	Programmi di grafica preferiti	2015-06-13 13:19:55.898	<br><br><input type=radio name=sonda value=Blender required>Blender<br><input type=radio name=sonda value=Maya required>Maya<br><input type=radio name=sonda value=Houdini required>Houdini<br>		f	alice	data:image/jpeg;base64,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
\.


--
-- TOC entry 2067 (class 0 OID 0)
-- Dependencies: 175
-- Name: sondaggio_idd_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sondaggio_idd_seq', 7, true);


--
-- TOC entry 2045 (class 0 OID 33305)
-- Dependencies: 177
-- Data for Name: topic1; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY topic1 (nomec, idd) FROM stdin;
grafica	1
basi di dati	2
letteratura	8
basi di dati	12
informatica	13
informatica	17
grafica	20
fantasy	6
fiori	7
fiori	10
sport	11
giardinaggio	16
giardinaggio	18
\.


--
-- TOC entry 2046 (class 0 OID 33320)
-- Dependencies: 178
-- Data for Name: topic2; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY topic2 (nomec, idd) FROM stdin;
cucina	1
informatica	3
sport	4
fiori	5
giardinaggio	6
grafica	7
\.


--
-- TOC entry 2038 (class 0 OID 33232)
-- Dependencies: 170
-- Data for Name: utente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY utente (nome, email, password, residenza, tipo, datanascita) FROM stdin;
oite	oite@gmail.it	pippo	bergamo	vip	1990-10-20
morgana	morgy@outlook.it	merlino	sentiero dell' est	vip	\N
gregory	greg89@gmail.it	1234	milano	normale	1989-05-12
gelsomino	gelsy@hotmail.it	rosaspina	via delle rose 	normale	1995-02-13
guido	duidorossi@unimi.it	info123	\N	vip	\N
fede	feder94@hotmail.it	fortugatto1	pedrengo	normale	1994-10-04
alice	alice@gmail.it	milano2	bergamo	vip	1994-01-01
mik	michele@gmail.it	milano1	sul lago	vip	\N
ofelia	ofelia@hotmail.it	granburrone	passo ghiacciato	normale	1989-03-20
teo	ghettus@hotmail.it	elyn	ravenna	normale	\N
enrico	enrikrossi@unimi.it	rossomagenta	pisa	normale	1967-03-23
petunia	petuny@gmail.it	destiny	\N	vip	\N
jack	jack91@hotmail.it	blackflag123	\N	vip	1991-05-14
fra	francy@outlook.it	password1	modena	normale	1978-06-12
matte	mattemarras@gmail.it	1234	\N	vip	\N
gennaro	gennaro@gmail.it	gigi	\N	normale	\N
\.


--
-- TOC entry 2051 (class 0 OID 33383)
-- Dependencies: 183
-- Data for Name: voto; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY voto (nome, idr, voto) FROM stdin;
oite	17	t
alice	38	f
alice	30	f
alice	32	t
\.


-- Completed on 2015-06-13 15:25:23

--
-- PostgreSQL database dump complete
--

