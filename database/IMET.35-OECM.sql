BEGIN;

DROP SCHEMA IF EXISTS imet_oecm;

CREATE SCHEMA imet_oecm;

-- ### Form tables ##

CREATE TABLE imet_oecm.imet_form
(
    "FormID"     serial PRIMARY KEY,
    "Year"       integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "language"   character(2),
    version      character(4),
    "Country"    character(3),
    validation   character varying(25),
    wdpa_id      integer,
    name         text
);

CREATE TABLE imet_oecm.imet_encoders
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    first_name   character varying,
    last_name    character varying,
    organisation character varying,
    function     character varying,
    "UpdateDate" character varying(30),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

-- ##########################################
-- ######  Modules' tables  - CONTEXT  ######
-- ##########################################

CREATE TABLE imet_oecm.context_encoding_responsables_interviewees
(
    id                 serial PRIMARY KEY,
    "FormID"           integer,
    "UpdateBy"         integer,
    "UpdateDate"       character varying(30),
    "Name"             text,
    "Institution"      text,
    "Function"         text,
    "Contacts"         text,
    "EncodingDate"     character varying(30),
    "EncodingDuration" text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_encoding_responsables_interviewers
(
    id                 serial PRIMARY KEY,
    "FormID"           integer,
    "UpdateBy"         integer,
    "UpdateDate"       character varying(30),
    "Name"             text,
    "Institution"      text,
    "Function"         text,
    "Contacts"         text,
    "EncodingDate"     character varying(30),
    "EncodingDuration" text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.designation
(
    id                            serial PRIMARY KEY,
    "FormID"                      integer,
    "UpdateBy"                    integer,
    "UpdateDate"                  character varying(30),
    "Aspect"                      text,
    "EvaluationScore"             numeric,
    "Comments"                    text,
    "SignificativeClassification" boolean,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_general_info
(
    id                    serial PRIMARY KEY,
    "FormID"              integer,
    "UpdateBy"            integer,
    "UpdateDate"          character varying(30),
    "CompleteName"        text,
    "UsedName"            text,
    "CompleteNameWDPA"    text,
    "WDPA"                integer,
    "Type"                character varying(35),
    "Country"             character(3),
    "CreationYear"        integer,
    "ReferenceText"       text,
    "ReferenceTextValues" text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_special_status
(
    id                    serial PRIMARY KEY,
    "FormID"              integer,
    "UpdateBy"            integer,
    "UpdateDate"          character varying(30),
    "Designation"         character varying(250),
    "RegistrationDate"    character varying(30),
    "DesignationCriteria" text,
    "Code"                character varying(250),
    "Area"                numeric,
    upload                character varying(256),
    "upload_BYTEA"        bytea,
    group_key             character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_networks
(
    id               serial PRIMARY KEY,
    "FormID"         integer,
    "UpdateBy"       integer,
    "UpdateDate"     character varying(30),
    "NetworkName"    text,
    "ProtectedAreas" text,
    group_key        character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_missions
(
    id               serial PRIMARY KEY,
    "FormID"         integer,
    "UpdateBy"       integer,
    "UpdateDate"     character varying(30),
    "LocalVision"    text,
    "LocalMission"   text,
    "LocalObjective" text,
    "LocalSource"    text,
    "Observation"    text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_contexts
(
    id             serial PRIMARY KEY,
    "FormID"       integer,
    "UpdateBy"     integer,
    "UpdateDate"   character varying(30),
    "Context"      text,
    file           text,
    "file_BYTEA"   bytea,
    "Summary"      text,
    "Observations" text,
    "Source"       text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_objectives1
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "Status"     text,
    "Benchmark1" text,
    "Benchmark2" text,
    "Objective"  text,
    "Benchmark3" text,
    "Comments"   text,
    "Element"    text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE imet_oecm.context_objectives4
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "Status"     text,
    "Benchmark1" text,
    "Benchmark2" text,
    "Objective"  text,
    "Benchmark3" text,
    "Comments"   text,
    "Element"    text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_objectives5
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "Status"     text,
    "Benchmark1" text,
    "Benchmark2" text,
    "Objective"  text,
    "Benchmark3" text,
    "Comments"   text,
    "Element"    text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_objectives6
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "Status"     text,
    "Benchmark1" text,
    "Benchmark2" text,
    "Objective"  text,
    "Benchmark3" text,
    "Comments"   text,
    "Element"    text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_localization
(
    id                       serial PRIMARY KEY,
    "FormID"                 integer,
    "UpdateBy"               integer,
    "UpdateDate"             character varying(30),
    "LimitsExist"            boolean,
    "Shapefile"              character varying(255),
    "Shapefile_BYTEA"        bytea,
    "SourceSHP"              text,
    "Coordinates"            text,
    "SourceCoords"           text,
    "AdministrativeLocation" text,
    "Observations"           text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_areas
(
    id                   serial PRIMARY KEY,
    "FormID"             integer,
    "UpdateBy"           integer,
    "UpdateDate"         character varying(30),
    "AdministrativeArea" numeric,
    "WDPAArea"           numeric,
    "GISArea"            numeric,
    "TerrestrialArea"    numeric,
    "MarineArea"         numeric,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_objectives2
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "Status"     text,
    "Benchmark1" text,
    "Benchmark2" text,
    "Objective"  text,
    "Benchmark3" text,
    "Comments"   text,
    "Element"    text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_objectives3
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "Status"     text,
    "Benchmark1" text,
    "Benchmark2" text,
    "Objective"  text,
    "Benchmark3" text,
    "Comments"   text,
    "Element"    text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_management_staff
(
    id               serial PRIMARY KEY,
    "FormID"         integer,
    "UpdateBy"       integer,
    "UpdateDate"     character varying(30),
    "Function"       text,
    "Number"         numeric,
    "Male"           text,
    "Female"         text,
    "Descriptions"   text,
    "AdequateNumber" integer,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_management_staff_partners
(
    id             serial PRIMARY KEY,
    "FormID"       integer,
    "UpdateBy"     integer,
    "UpdateDate"   character varying(30),
    "Partner"      text,
    "Coordinators" numeric,
    "Technicians"  numeric,
    "Auxiliaries"  numeric,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_financial_resources
(
    id                           serial PRIMARY KEY,
    "FormID"                     integer,
    "UpdateBy"                   integer,
    "UpdateDate"                 character varying(30),
    "Currency"                   character(3),
    "TotalAnnualBudgetAvailable" numeric,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_equipments
(
    id              serial PRIMARY KEY,
    "FormID"        integer,
    "UpdateBy"      integer,
    "UpdateDate"    character varying(30),
    "Resource"      character varying(250),
    "AdequacyLevel" numeric,
    "Comments"      text,
    group_key       character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_species_animal_presence
(
    id                     serial PRIMARY KEY,
    "FormID"               integer,
    "UpdateBy"             integer,
    "UpdateDate"           character varying(30),
    "SpeciesID"            integer,
    "ExploitedSpecies"     boolean,
    "ProtectedSpecies"     boolean,
    "DisappearingSpecies"  boolean,
    "InvasiveSpecies"      boolean,
    "PopulationEstimation" numeric,
    "DescribeEstimation"   text,
    "Comments"             text,
    species                character varying(250),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_species_vegetal_presence
(
    id                     serial PRIMARY KEY,
    "FormID"               integer,
    "UpdateBy"             integer,
    "UpdateDate"           character varying(30),
    "SpeciesID"            integer,
    "ExploitedSpecies"     boolean,
    "ProtectedSpecies"     boolean,
    "DisappearingSpecies"  boolean,
    "InvasiveSpecies"      boolean,
    "PopulationEstimation" numeric,
    "DescribeEstimation"   text,
    "Comments"             text,
    species                character varying(250),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.context_habitats
(
    id                     serial PRIMARY KEY,
    "FormID"               integer,
    "UpdateBy"             integer,
    "UpdateDate"           character varying(30),
    "EcosystemType"        text,
    "ExploitedSpecies"     boolean,
    "ProtectedSpecies"     boolean,
    "DisappearingSpecies"  boolean,
    "PopulationEstimation" numeric,
    "DescribeEstimation"   text,
    "Comments"             text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE imet_oecm.context_stakeholders_natural_resources
(
    id                      serial PRIMARY KEY,
    "FormID"                integer,
    "UpdateBy"              integer,
    "UpdateDate"            character varying(30),
    "Element"               text,
    "GeographicalProximity" boolean,
    "Engagement"            text,
    "Impact"                numeric,
    "Role"                  numeric,
    "Comments"              text,
    group_key               character varying(50),
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);


-- #############################################
-- ######  Modules' tables  - EVALUATION  ######
-- #############################################

CREATE TABLE imet_oecm.eval_regulations_adequacy (
    id                  serial PRIMARY KEY,
    "FormID"            integer,
    "UpdateBy"          integer,
    "UpdateDate"        character varying(30),
    "Regulation"        text,
    "EvaluationScore"   numeric,
    "Comments"          text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_design_adequacy (
    id                  serial PRIMARY KEY,
    "FormID"            integer,
    "UpdateBy"          integer,
    "UpdateDate"        character varying(30),
    "Values"            text,
    "EvaluationScore"   numeric,
    "Comments"          text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_boundary_level
(
    id                      serial PRIMARY KEY,
    "FormID"                integer,
    "UpdateBy"              integer,
    "UpdateDate"            character varying(30),
    "Boundaries"            numeric,
    "Adequacy"              numeric,
    "Comments"              text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_management_plan (
    id                  serial PRIMARY KEY,
    "FormID"            integer,
    "UpdateBy"          integer,
    "UpdateDate"        character varying(30),
    "PlanExistence"     boolean,
    "PlanUptoDate"      boolean,
    "PlanApproved"      boolean,
    "PlanImplemented"   boolean,
    "PlanAdequacyScore" numeric,
    "Comments" text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_work_plan (
    id                  serial PRIMARY KEY,
    "FormID"            integer,
    "UpdateBy"          integer,
    "UpdateDate"        character varying(30),
    "PlanExistence"     boolean,
    "PlanUptoDate"      boolean,
    "PlanApproved"      boolean,
    "PlanImplemented"   boolean,
    "PlanAdequacyScore" numeric,
    "Comments" text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_objectives (
    id                  serial PRIMARY KEY,
    "FormID"            integer,
    "UpdateBy"          integer,
    "UpdateDate"        character varying(30),
    "EvaluationScore"   numeric,
    "Comments"          text,
    "Objective"         text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE imet_oecm.eval_objectives_planification (
    id serial PRIMARY KEY,
    "FormID" integer,
    "UpdateBy" integer,
    "UpdateDate" character varying(30),
    "Element" text,
    "Status" text,
    "Objective" text,
    "Comments" text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);


COMMIT;
