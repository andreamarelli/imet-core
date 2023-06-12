BEGIN;

ALTER TABLE imet_oecm.context_governance ADD COLUMN IF NOT EXISTS "SubGovernanceModel" character varying(250);

COMMIT;