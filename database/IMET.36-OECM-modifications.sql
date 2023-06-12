BEGIN;

ALTER TABLE imet_oecm.context_governance ADD COLUMN IF NOT EXISTS "SubGovernanceModel" character varying(250);
ALTER TABLE imet_oecm.context_governance ADD COLUMN IF NOT EXISTS "MemberRepresentativenessLevel" integer;
ALTER TABLE imet_oecm.context_governance ADD COLUMN IF NOT EXISTS "AdditionalInformation" text;

COMMIT;