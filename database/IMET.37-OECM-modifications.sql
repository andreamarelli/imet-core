BEGIN;

ALTER TABLE imet_oecm.context_governance DROP COLUMN IF EXISTS "ManagementList";
DELETE FROM imet_oecm.context_analysis_stakeholders_direct_users WHERE group_key IN ('group11', 'group12', 'group13');
DELETE FROM imet_oecm.context_analysis_stakeholders_indirect_users WHERE group_key IN ('group11', 'group12', 'group13');

COMMIT;