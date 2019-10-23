--
-- PostgreSQL database dump
--

-- Dumped from database version 12.0 (Debian 12.0-2.pgdg100+1)
-- Dumped by pg_dump version 12.0 (Debian 12.0-2.pgdg100+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: formation; Type: TABLE; Schema: public; Owner: maxence
--

CREATE TABLE public.formation (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    description text,
    author character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.formation OWNER TO maxence;

--
-- Name: formation_id_seq; Type: SEQUENCE; Schema: public; Owner: maxence
--

CREATE SEQUENCE public.formation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.formation_id_seq OWNER TO maxence;

--
-- Name: lesson; Type: TABLE; Schema: public; Owner: maxence
--

CREATE TABLE public.lesson (
    id integer NOT NULL,
    formation_id integer,
    title character varying(255) NOT NULL,
    description text,
    content text NOT NULL,
    author character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.lesson OWNER TO maxence;

--
-- Name: lesson_id_seq; Type: SEQUENCE; Schema: public; Owner: maxence
--

CREATE SEQUENCE public.lesson_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.lesson_id_seq OWNER TO maxence;

--
-- Name: migration_versions; Type: TABLE; Schema: public; Owner: maxence
--

CREATE TABLE public.migration_versions (
    version character varying(14) NOT NULL,
    executed_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.migration_versions OWNER TO maxence;

--
-- Name: COLUMN migration_versions.executed_at; Type: COMMENT; Schema: public; Owner: maxence
--

COMMENT ON COLUMN public.migration_versions.executed_at IS '(DC2Type:datetime_immutable)';


--
-- Name: user; Type: TABLE; Schema: public; Owner: maxence
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    username character varying(255) NOT NULL,
    password character varying(255) NOT NULL
);


ALTER TABLE public."user" OWNER TO maxence;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: maxence
--

CREATE SEQUENCE public.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO maxence;

--
-- Data for Name: formation; Type: TABLE DATA; Schema: public; Owner: maxence
--

COPY public.formation (id, title, description, author, created_at) FROM stdin;
\.


--
-- Data for Name: lesson; Type: TABLE DATA; Schema: public; Owner: maxence
--

COPY public.lesson (id, formation_id, title, description, content, author, created_at) FROM stdin;
\.


--
-- Data for Name: migration_versions; Type: TABLE DATA; Schema: public; Owner: maxence
--

COPY public.migration_versions (version, executed_at) FROM stdin;
20191023203538	2019-10-23 20:36:09
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: maxence
--

COPY public."user" (id, username, password) FROM stdin;
\.


--
-- Name: formation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: maxence
--

SELECT pg_catalog.setval('public.formation_id_seq', 1, false);


--
-- Name: lesson_id_seq; Type: SEQUENCE SET; Schema: public; Owner: maxence
--

SELECT pg_catalog.setval('public.lesson_id_seq', 1, false);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: maxence
--

SELECT pg_catalog.setval('public.user_id_seq', 1, false);


--
-- Name: formation formation_pkey; Type: CONSTRAINT; Schema: public; Owner: maxence
--

ALTER TABLE ONLY public.formation
    ADD CONSTRAINT formation_pkey PRIMARY KEY (id);


--
-- Name: lesson lesson_pkey; Type: CONSTRAINT; Schema: public; Owner: maxence
--

ALTER TABLE ONLY public.lesson
    ADD CONSTRAINT lesson_pkey PRIMARY KEY (id);


--
-- Name: migration_versions migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: maxence
--

ALTER TABLE ONLY public.migration_versions
    ADD CONSTRAINT migration_versions_pkey PRIMARY KEY (version);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: maxence
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: idx_f87474f35200282e; Type: INDEX; Schema: public; Owner: maxence
--

CREATE INDEX idx_f87474f35200282e ON public.lesson USING btree (formation_id);


--
-- Name: lesson fk_f87474f35200282e; Type: FK CONSTRAINT; Schema: public; Owner: maxence
--

ALTER TABLE ONLY public.lesson
    ADD CONSTRAINT fk_f87474f35200282e FOREIGN KEY (formation_id) REFERENCES public.formation(id);


--
-- PostgreSQL database dump complete
--