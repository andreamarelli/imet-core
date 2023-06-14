BEGIN;

-- Governance
ALTER TABLE imet_oecm.context_governance ADD COLUMN IF NOT EXISTS "SubGovernanceModel" character varying(250);
ALTER TABLE imet_oecm.context_governance ADD COLUMN IF NOT EXISTS "MemberRepresentativenessLevel" integer;
ALTER TABLE imet_oecm.context_governance ADD COLUMN IF NOT EXISTS "AdditionalInformation" text;

-- Areas
ALTER TABLE imet_oecm.context_areas ADD COLUMN IF NOT EXISTS "StrictConservationArea" numeric;

-- Habitats
ALTER TABLE imet_oecm.context_habitats ADD COLUMN IF NOT EXISTS "EcosystemDescription" text;

-- StakeholdersNaturalResources
ALTER TABLE imet_oecm.context_stakeholders_natural_resources DROP COLUMN IF EXISTS "Engagement";
ALTER TABLE imet_oecm.context_stakeholders_natural_resources DROP COLUMN IF EXISTS "Impact";
ALTER TABLE imet_oecm.context_stakeholders_natural_resources DROP COLUMN IF EXISTS "Role";
ALTER TABLE imet_oecm.context_stakeholders_natural_resources ADD COLUMN IF NOT EXISTS "UsesCategories" text;
ALTER TABLE imet_oecm.context_stakeholders_natural_resources ADD COLUMN IF NOT EXISTS "DirectUser" boolean;
ALTER TABLE imet_oecm.context_stakeholders_natural_resources ADD COLUMN IF NOT EXISTS "LevelEngagement" numeric;
ALTER TABLE imet_oecm.context_stakeholders_natural_resources ADD COLUMN IF NOT EXISTS "LevelInterest" numeric;
ALTER TABLE imet_oecm.context_stakeholders_natural_resources ADD COLUMN IF NOT EXISTS "LevelExpertise" numeric;

-- StakeholdersObjectives
CREATE TABLE imet_oecm.context_stakeholders_objectives
(
    id           serial PRIMARY KEY,
    "FormID"     integer,
    "UpdateBy"   integer,
    "UpdateDate" character varying(30),
    "Status"     text,
    "ShortOrLongTerm" varchar(50),
    "Comments"   text,
    "Element"    text,
    CONSTRAINT "FormID_fk" FOREIGN KEY ("FormID") REFERENCES imet_oecm.imet_form ("FormID") MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
);

COMMIT;