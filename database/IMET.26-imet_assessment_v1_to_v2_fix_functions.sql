BEGIN;

DROP FUNCTION imet_assessment_v1_to_v2.get_imet_evaluation_stats_by_formid_step6(text, text);

CREATE OR REPLACE FUNCTION imet_assessment_v1_to_v2.get_imet_evaluation_stats_by_formid_step6(
	form_id text DEFAULT NULL::text,
	c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 character, name text, oc1 numeric, oc2 numeric, oc3 numeric, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
sql text;
  parameters text DEFAULT 'NULL';

BEGIN

    if form_id is not null then
        parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        parameters:= parameters || ','''||c_iso3||'''';
    end if;


    sql := ' WITH table0 AS (
         SELECT A.formid,
            A.wdpa_id,
            A.iso3,
            A.name,
            A.ei1 * 0.76 AS oc1,
            round(((COALESCE(A.ei2::double precision, 0::numeric::double precision) + COALESCE(A.ei3)::double precision) / 2::double precision)::numeric, 2) AS oc2,
            A.ei4 AS oc3
           FROM imet_assessment.get_imet_evaluation_stats_by_formid_step6('||parameters||') AS A
        )
 SELECT DISTINCT table0.formid,
    table0.wdpa_id,
    table0.iso3,
    table0.name,
    table0.oc1,
    table0.oc2,
    table0.oc3,
    round(((COALESCE(table0.ei1, 0::numeric)::double precision + COALESCE(table0.ei2::double precision / 2::double precision + 50::double precision, 0::double precision) + COALESCE(table0.ei3::double precision / 2::double precision + 50::double precision, 0::double precision)) / NULLIF(( SELECT count(*) AS count
           FROM ( VALUES (table0.ei1), (table0.ei2), (table0.ei3)) v(col)
          WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS avg_indicator
   FROM table0;';

RETURN QUERY EXECUTE sql;

END;
$BODY$;

DROP FUNCTION imet_assessment_v1_to_v2.get_imet_evaluation_stats_by_formid_step5(text, text);

CREATE OR REPLACE FUNCTION imet_assessment_v1_to_v2.get_imet_evaluation_stats_by_formid_step5(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 character, name text, op1 numeric, op2 numeric, op3 double precision, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        parameters:= parameters || ','''||c_iso3||'''';
    end if;

    sql := 'WITH table0 AS (
         SELECT DISTINCT A.formid,
            A.wdpa_id,
            A.iso3,
            A.name,
            A.r1 * 0.76 AS r1,
            A.r2 * 0.76 AS r2
           FROM imet_assessment.get_imet_evaluation_stats_by_formid_step5('||parameters||') AS A
        ), table1 AS (
         SELECT get_imet_evaluation_stats_rank_all.formid,
            get_imet_evaluation_stats_rank_all.section,
            get_imet_evaluation_stats_rank_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_rank_all(''eval_control''::text, ''EvaluationScore''::text, ''EVAL PR9''::text, '''||form_id||''') get_imet_evaluation_stats_rank_all(formid, section, value_p)
        ), tableall AS (
         SELECT a.formid,
            a.wdpa_id,
            a.iso3,
            a.name,
            round(a.r1, 2) AS op1,
            round(a.r2, 2) AS op2,
            b.value_p AS op3
           FROM table0 a
             LEFT JOIN table1 b ON a.formid = b.formid
        )
 SELECT DISTINCT tableall.formid,
    tableall.wdpa_id,
    tableall.iso3,
    tableall.name,
    tableall.op1,
    tableall.op2,
    tableall.op3,
    round((((COALESCE(tableall.op1, 0::numeric) + COALESCE(tableall.op2, 0::numeric))::double precision + COALESCE(tableall.op3, 0::numeric::double precision)) / NULLIF(( SELECT count(*) AS count
           FROM ( VALUES (tableall.op1), (tableall.op2), (tableall.op3)) v(col)
          WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 2) AS avg_indicator
   FROM tableall;';
    raise notice 'sql : %',sql;
    RETURN QUERY EXECUTE sql;
END;
$BODY$;

COMMIT;
