BEGIN;

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "long_term_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "long_term_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "long_term_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "long_term_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "long_term_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "annual_targets_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "annual_targets_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "annual_targets_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "annual_targets_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "annual_targets_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_activity";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_activity_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_activity_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_activity_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_activity_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_activity_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_other";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_other_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_other_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_other_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_other_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention1_other_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_activity";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_activity_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_activity_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_activity_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_activity_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_activity_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_other";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_other_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_other_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_other_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_other_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention2_other_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_activity";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_activity_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_activity_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_activity_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_activity_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_activity_year5";

ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_other";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_other_year1";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_other_year2";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_other_year3";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_other_year4";
ALTER TABLE imet_oecm.imet_report DROP COLUMN IF EXISTS "intervention3_other_year5";

ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets1 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets1_activity1 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets1_activity1_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets1_activity1_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets1_activity1_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets1_activity1_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets1_activity1_year5 boolean default false;

ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets1_activity2 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets1_activity2_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets1_activity2_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets1_activity2_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets1_activity2_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets1_activity2_year5 boolean default false;

ALTER TABLE imet_oecm.imet_report ADD COLUMN outcome2 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN outcome2_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN outcome2_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN outcome2_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN outcome2_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN outcome2_year5 boolean default false;

ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity1 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity1_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity1_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity1_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity1_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity1_year5 boolean default false;

ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity2 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity2_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity2_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity2_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity2_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity2_year5 boolean default false;

ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity3 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity3_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity3_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity3_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity3_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity3_year5 boolean default false;

ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity4 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity4_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity4_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity4_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity4_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity4_year5 boolean default false;

ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity5 text;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity5_year1 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity5_year2 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity5_year3 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity5_year4 boolean default false;
ALTER TABLE imet_oecm.imet_report ADD COLUMN annual_targets2_activity5_year5 boolean default false;

COMMIT;
