BEGIN;

DROP SCHEMA IF EXISTS imet_oecm;

CREATE SCHEMA imet_oecm;

-- ### Form tables ##

CREATE TABLE imet_oecm.imet_form (
    "FormID" serial PRIMARY KEY,
    "Year" integer,
    "UpdateBy" integer,
    "UpdateDate" character varying(30),
    "language" character(2),
    version character(4),
    "Country" character(3),
    validation character varying(25),
    wdpa_id integer,
    name text
);

CREATE TABLE imet_oecm.imet_encoders (
    id serial PRIMARY KEY,
    "FormID" integer,
    first_name character varying,
    last_name character varying,
    organisation character varying,
    function character varying,
    "UpdateDate" character varying(30),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);


-- ### Modules' tables ##

CREATE TABLE imet_oecm.context_encoding_responsables_interviewees (
    id serial PRIMARY KEY,
    "FormID" integer,
    "UpdateBy" integer,
    "UpdateDate" character varying(30),
    "Name" text,
    "Institution" text,
    "Function" text,
    "Contacts" text,
    "EncodingDate" character varying(30),
    "EncodingDuration" text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_encoding_responsables_interviewers (
    id serial PRIMARY KEY,
    "FormID" integer,
    "UpdateBy" integer,
    "UpdateDate" character varying(30),
    "Name" text,
    "Institution" text,
    "Function" text,
    "Contacts" text,
    "EncodingDate" character varying(30),
    "EncodingDuration" text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.designation (
    id serial PRIMARY KEY,
    "FormID" integer,
    "UpdateBy" integer,
    "UpdateDate" character varying(30),
    "Aspect" text,
    "EvaluationScore" numeric,
    "Comments" text,
    "SignificativeClassification" boolean,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

COMMIT;