BEGIN;

ALTER TABLE imet.context_general_info ADD COLUMN IF NOT EXISTS "MarineDesignation" varchar(250);
UPDATE imet.eval_management_activities SET group_key = 'group2' WHERE group_key = 'group3';
UPDATE imet.eval_management_activities SET group_key = 'group3' WHERE group_key = 'group4';
UPDATE imet.eval_management_activities SET group_key = 'group4' WHERE group_key = 'group5';
UPDATE imet.eval_management_activities SET group_key = 'group5' WHERE group_key = 'group6';

ALTER TABLE imet.eval_law_enforcement_implementation ADD COLUMN IF NOT EXISTS "group_key" varchar(50);
UPDATE imet.eval_law_enforcement_implementation SET group_key = 'group0';

CREATE TABLE  IF NOT EXISTS imet.eval_area_domination_mpa
(
    id serial primary key,
    "FormID" integer
        constraint "FormID_fk"
            references imet.imet_form
            on update cascade on delete cascade,
    "UpdateBy"          integer,
    "UpdateDate"        varchar(30),
    "group_key"        varchar(50),
    "Activity"          text,
    "Patrol"            numeric,
    "RapidIntervention" numeric,
    "DetectionRemoteSensing"       boolean,
    "SpecialMeansRapidIntervention"            boolean
);


COMMIT;
