BEGIN;

ALTER TABLE imet_oecm.context_governance DROP COLUMN IF EXISTS "ManagementList";
DELETE FROM imet_oecm.context_analysis_stakeholders_direct_users WHERE group_key IN ('group11', 'group12', 'group13');
DELETE FROM imet_oecm.context_analysis_stakeholders_indirect_users WHERE group_key IN ('group11', 'group12', 'group13');
ALTER TABLE imet_oecm.context_analysis_stakeholders_direct_users DROP COLUMN IF EXISTS "Description";
ALTER TABLE imet_oecm.context_analysis_stakeholders_indirect_users DROP COLUMN IF EXISTS "Description";
DELETE FROM imet_oecm.eval_supports_constraints WHERE group_key IS null;
DELETE FROM imet_oecm.eval_supports_constraints_integration WHERE group_key IS null;

COMMIT;