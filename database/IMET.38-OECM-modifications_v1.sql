BEGIN;
CREATE TABLE IF NOT EXISTS imet.context_objectives4 (
    id serial PRIMARY KEY,
    "FormID" integer,
    "UpdateBy" integer,
    "UpdateDate" character varying(30),
    "Status" text,
    "Benchmark1" text,
    "Benchmark2" text,
    "Objective" text,
    "Benchmark3" text,
    "Comments" text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);
COMMIT;