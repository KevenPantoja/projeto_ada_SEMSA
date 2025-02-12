# -- coding: utf-8 --
#from sqlalchemy import MetaData, create_engine
import sqlalchemy as sa
import pandas as pd
import pangres as pn
from sqlalchemy import text

schema = 'novo_ada'

mapcbo = {'1999A1':'199911','1999A2':'199912','2231A1':'223111','2231A2':'223112','5152A1':'515211','1312C1':'131231','2231F8':'223168','2231F9':'223169','2231G1':'223171','2235C3':'223533','2236I1':'223691','3135D1':'313541','3135D2':'313542','5151F1':'515161','2241E1':'224151'}

##conexão com CNES
cnes_conn = sa.create_engine('postgresql+psycopg2://postgres:esus@172.21.2.65:5432/postgres', echo=True).connect()

##conexão banco novo_ada
novo_ada = sa.create_engine('postgresql+psycopg2://did:xfm32HFk6DMEwv9h@172.17.135.171:5432/serverdados?options=-csearch_path%3Dnovo_ada', echo=True).connect()

##copy lfces021
lfces021 = pd.read_sql_query('select * from "cnes"."LFCES021"',cnes_conn)
lfces021['UNIDADE_ID']= lfces021['UNIDADE_ID'].apply(lambda x: int(x))
lfces021['PROF_ID']= lfces021['PROF_ID'].apply(lambda x: int(x))
lfces021.to_sql(
    con=novo_ada,
    name='lfces021',
    schema=schema,
    index=False,
    if_exists='replace'
)

##copy nfces085
nfces085 = pd.read_sql_query('select * from "cnes"."NFCES085"',cnes_conn)
nfces085['CO_NATUREZA_JUR']= nfces085['CO_NATUREZA_JUR'].apply(lambda x: int(x))
nfces085.to_sql(
    con=novo_ada,
    name='nfces085',
    schema=schema,
    index=False,
    if_exists='replace'
)

##copy lfces004

lfces004 = pd.read_sql_query('select * from "cnes"."LFCES004"',cnes_conn)
lfces004['UNIDADE_ID']= lfces004['UNIDADE_ID'].apply(lambda x: int(x))
#lfces004['CD_MOTIVO_DESAB']= lfces004['CD_MOTIVO_DESAB'].apply(lambda x: int(x))
lfces004.to_sql(
    con=novo_ada,
    name='lfces004',
    schema=schema,
    index=False,
    if_exists='replace'
)

##copy lfces040
lfces040 = pd.read_sql_query('select * from "cnes"."LFCES040"',cnes_conn)
lfces040['CD_SEGMENTO']= lfces040['CD_SEGMENTO'].apply(lambda x: int(x))
lfces040.to_sql(
    con=novo_ada,
    name='lfces040',
    schema=schema,
    index=False,
    if_exists='replace'
)


##copy nfces049
nfces049 = pd.read_sql_query('select * from "cnes"."NFCES049"',cnes_conn)
#nfces049['CD_MOTIVO_DESAB']= nfces049['CD_MOTIVO_DESAB'].apply(lambda x: int(x))
nfces049.to_sql(
    con=novo_ada,
    name='nfces049',
    schema=schema,
    index=False,
    if_exists='replace'
)

##copy nfces010
nfces010 = pd.read_sql_query('select * from "cnes"."NFCES010"',cnes_conn)
#nfces010['TP_UNID_ID']= nfces010['TP_UNID_ID'].apply(lambda x: int(x))
nfces010.to_sql(
    con=novo_ada,
    name='nfces010',
    schema=schema,
    index=False,
    if_exists='replace'
)

##copy nfces085
nfces085 = pd.read_sql_query('select * from "cnes"."NFCES085"',cnes_conn)
nfces085['CO_NATUREZA_JUR']= nfces085['CO_NATUREZA_JUR'].apply(lambda x: int(x))
nfces085.to_sql(
    con=novo_ada,
    name='nfces085',
    schema=schema,
    index=False,
    if_exists='replace'
)

##copy lfces004

lfces004 = pd.read_sql_query('select * from "cnes"."LFCES004"',cnes_conn)
lfces004['UNIDADE_ID']= lfces004['UNIDADE_ID'].apply(lambda x: int(x))
#lfces004['CD_MOTIVO_DESAB']= lfces004['CD_MOTIVO_DESAB'].apply(lambda x: int(x))
lfces004.to_sql(
    con=novo_ada,
    name='lfces004',
    schema=schema,
    index=False,
    if_exists='replace'
)

##copy lfces040
lfces040 = pd.read_sql_query('select * from "cnes"."LFCES040"',cnes_conn)
lfces040['CD_SEGMENTO']= lfces040['CD_SEGMENTO'].apply(lambda x: int(x))
lfces040.to_sql(
    con=novo_ada,
    name='lfces040',
    schema=schema,
    index=False,
    if_exists='replace'
)


##copy nfces049
nfces049 = pd.read_sql_query('select * from "cnes"."NFCES049"',cnes_conn)
#nfces049['CD_MOTIVO_DESAB']= nfces049['CD_MOTIVO_DESAB'].apply(lambda x: int(x))
nfces049.to_sql(
    con=novo_ada,
    name='nfces049',
    schema=schema,
    index=False,
    if_exists='replace'
)

##copy nfces010
nfces010 = pd.read_sql_query('select * from "cnes"."NFCES010"',cnes_conn)
#nfces010['TP_UNID_ID']= nfces010['TP_UNID_ID'].apply(lambda x: int(x))
nfces010.to_sql(
    con=novo_ada,
    name='nfces010',
    schema=schema,
    index=False,
    if_exists='replace'
)

##copy lfces038
lfces038 = pd.read_sql_query('select * from "cnes"."LFCES038"',cnes_conn)
lfces038['UNIDADE_ID']= lfces038['UNIDADE_ID'].apply(lambda x: int(x))
lfces038['PROF_ID']= lfces038['PROF_ID'].apply(lambda x: int(x))
lfces038['COD_CBO'] = lfces038['COD_CBO'].map(lambda s: mapcbo.get(s) if s in mapcbo else s)
lfces038.to_sql(
    con=novo_ada,
    name='lfces038',
    schema=schema,
    index=False,
    if_exists='replace'
)

##copy lfces037
lfces037 = pd.read_sql_query('select * from "cnes"."LFCES037"',cnes_conn)
lfces037['UNIDADE_ID']= lfces037['UNIDADE_ID'].apply(lambda x: int(x))
lfces037.to_sql(
    con=novo_ada,
    name='lfces037',
    schema=schema,
    index=False,
    if_exists='replace'
)

##copy lfces059
lfces059 = pd.read_sql_query('select * from "cnes"."LFCES059"',cnes_conn)
lfces059.to_sql(
    con=novo_ada,
    name='lfces059',
    schema=schema,
    index=False,
    if_exists='replace'
)

##copy nfces057
nfces057 = pd.read_sql_query('select * from "cnes"."NFCES057"',cnes_conn)
nfces057.to_sql(
    con=novo_ada,
    name='tb_vinc_empreg',
    schema=schema,
    index=False,
    if_exists='replace'
)

##copy nfces056
nfces056 = pd.read_sql_query('select * from "cnes"."NFCES056"',cnes_conn)

nfces056 = nfces056.set_index('CD_VINCULACAO')

pn.upsert(
    con=novo_ada,
    df=nfces056,
    table_name='tb_dim_vinc_estab',
    if_row_exists='ignore',
    dtype=None,
    chunksize=1000,
    create_table=False,
    schema=schema
)

#nfces056.to_sql(
#    con=novo_ada,
#    name='tb_dim_vinc_estab',
#    schema=schema,
#    index=False,
#    if_exists='replace'
#)

##copy nfces033
nfces033 = pd.read_sql_query('select * from "cnes"."NFCES033"',cnes_conn)

nfces033 = nfces033.set_index('CODORGEMIS')

pn.upsert(
    con=novo_ada,
    df=nfces033,
    table_name='tb_dim_conselho',
    if_row_exists='ignore',
    dtype=None,
    chunksize=1000,
    create_table=False,
    schema=schema
)
#nfces033.to_sql(
#    con=novo_ada,
#    name='tb_dim_conselho',
#    schema=schema,
#    index=False,
#    if_exists='replace'
#)


##copy ine_prt_homolog
ine_prt_homolog = pd.read_sql_query('select * from "cnes"."INE_PRT_HOMOLOG"',con=cnes_conn)
ine_prt_homolog.to_sql(
    con=novo_ada,
    name='ine_prt_homolog',
    schema=schema,
    index=False,
    if_exists='replace'
)

#dim_competencia

# Step 1: Retrieve the max `DATA_ATU` from the source table
data_query = 'SELECT MAX("DATA_ATU") FROM "cnes"."LFCES038"'
data = pd.read_sql_query(data_query, con=cnes_conn)
data = data['max'].values[0]

# Convert `data` to datetime if it's not zero
if data != '0':
    data = pd.to_datetime(data)

# Step 2: Retrieve the max `COMPETENCIA` from the source table
competencia_query = 'SELECT MAX("COMPETENCIA") FROM "cnes"."CNESHIST"'
competencia_cnes = pd.read_sql_query(competencia_query, con=cnes_conn)
competencia_cnes = competencia_cnes.values[0][0]  # Extract value from the DataFrame

# Append '00' to `competencia_cnes` to ensure it matches the required format
competencia_cnes = str(competencia_cnes) + '00'

# Define validity flag and create a DataFrame with the new record
valido = False
tb_dim_competencia_cnes = pd.DataFrame(
    [[competencia_cnes, valido, data]],
    columns=['comp_competencia', 'comp_valido', 'comp_data']
)

# Step 3: Check existing records in the target table
existing_records_query = 'SELECT comp_competencia, comp_valido, comp_data FROM novo_ada.tb_dim_competencia'
tb_dim_competencia_sd = pd.read_sql_query(existing_records_query, con=novo_ada)

# Step 4: Filter out records that already exist in `tb_dim_competencia_sd`
# Keep only the rows in `tb_dim_competencia_cnes` with `comp_competencia` not present in `tb_dim_competencia_sd`
tb_dim_competencia = tb_dim_competencia_cnes[
    ~tb_dim_competencia_cnes['comp_data'].isin(tb_dim_competencia_sd['comp_data'])
]

print(tb_dim_competencia_sd)
print(tb_dim_competencia)

# Step 5: Insert new records if there are any
if not tb_dim_competencia.empty:
    tb_dim_competencia.to_sql(
        name='tb_dim_competencia',
        con=novo_ada,
        schema=schema,
        index=False,
        if_exists='append'  # Append new records only
    )
    print("New competencia inserted.")
else:
    print("No new competencia to insert.")


##dim_competencia
#data = pd.read_sql_query('select MAX("DATA_ATU") from "cnes"."LFCES038"',con=cnes_conn)
#data = data.loc[data['max'] != '0']['max'].values[0]
#competencia_cnes = str(data)
#competencia_cnes = competencia_cnes.replace('-','')
#competencia_cnes = pd.read_sql_query('SELECT MAX("COMPETENCIA") FROM "cnes"."CNESHIST"', con=cnes_conn)
#competencia_cnes = competencia_cnes['comp_competencia'].astype('int64')
#valido = False
#tb_dim_competencia_cnes = pd.DataFrame([[competencia_cnes,valido,data]],columns=['comp_competencia','comp_valido','comp_data'])
#tb_dim_competencia_cnes['comp_competencia'] = tb_dim_competencia_cnes['comp_competencia'].astype('int64')
#tb_dim_competencia_cnes['comp_data'] = tb_dim_competencia_cnes['comp_data'].astype('datetime64[ns]')

#tb_dim_competencia_sd = pd.read_sql_query('select comp_competencia, comp_valido, comp_data from novo_ada.tb_dim_competencia',con=novo_ada)

#tb_dim_competencia = tb_dim_competencia_cnes[~ tb_dim_competencia_cnes['comp_competencia'].isin(tb_dim_competencia_sd['comp_competencia'])]

#tb_dim_competencia = pd.DataFrame([[20240513,False,'13/05/2024']],columns=['comp_competencia','comp_valido','comp_data'])

#tb_dim_competencia.to_sql(
#    con=novo_ada,
#    name='tb_dim_competencia',
#    schema=schema,
#    index=False,
#    if_exists='append'  
#)

## get competencia atual

competenciaatual = pd.read_sql_query('select MAX(co_seq_dim_competencia) from novo_ada.tb_dim_competencia',con=novo_ada)
competenciaatual = competenciaatual.loc[competenciaatual['max'] != '0']['max'].values[0]

## copy VINC_EMPREG

vinc_empreg = pd.read_sql_query('select * from "cnes"."VINC_EMPREG"', con=cnes_conn)
vinc_empreg.to_sql(
    con=novo_ada,
    name='vinc_empreg',
    schema=schema,
    index=False,
    if_exists='replace'
)

##tb_tmp_prof_eas
tb_tmp_prof_eas = pd.read_sql_query(
    """
        with
        tmp_ult_fat_prof_cbo as ( select * from tb_fat_profissional_cbo tb 
	        where tb.co_seq_dim_competencia = (select max(c.co_seq_dim_competencia) from tb_dim_competencia c )), --where c.comp_valido is true
        ult_dim_competencia as (
	        select * from tb_dim_competencia tb 
	        where tb.co_seq_dim_competencia = (select max(c.co_seq_dim_competencia) from tb_dim_competencia c )) --where c.comp_valido is true
        select distinct 
        ds.dist_nome,
        tdu.und_cnes, 
        tdu.und_nome, 
        tdp.prof_nome, 
        tdp.prof_cpf, 
        tdc2.co_seq_dim_cbo, 
        tdc2.cbo_descricao, 
        tfpc.co_seq_fat_profissional_cbo, 
        tfpc.co_seq_dim_competencia, 
        tfpc.co_seq_dim_cargahoraria, 
        tfpc.cghorahosp, tfpc.cghoraoutr, 
        tdp.co_seq_dim_profissional, 
        tfpc.conselhoid, 
        tfpc.prof_numregistro, 
        tve."DS_VINCULACAO" as vinculo, 
        tvem."DS_VINCULO" as vinculo_tipo, 
        tdv.vinc_descricao as vinculo_subtipo,
        left(cpt.comp_competencia::text,6) as desc_compet
        from tb_dim_profissional tdp
        join tmp_ult_fat_prof_cbo tfpc on tfpc.co_seq_dim_profissional  = tdp.co_seq_dim_profissional 
        join tb_dim_unidade tdu on tdu.co_seq_dim_unidade = tfpc.unidade_id 
        join tb_dim_distrito ds on ds.co_seq_dim_distrito = tdu.co_seq_dim_distrito
        join tb_dim_cns tdc on tdc.co_seq_dim_profissional = tdp.co_seq_dim_profissional
        join tb_dim_cbo tdc2 on tdc2.co_seq_dim_cbo = tfpc.co_seq_dim_cbo
        join tb_dim_vinc_estab tve on tve."CD_VINCULACAO" = tfpc.cod_vinc 
        join tb_dim_vinc_empreg tvem on tvem."CD_VINCULACAO" = tfpc.cod_vinc and tvem."TP_VINCULO" =  tfpc.tp_vinc 
        join tb_dim_vinculo tdv on tdv.co_seq_fat_dim_vinculo = tfpc.co_seq_fat_dim_vinculo 
        join ult_dim_competencia cpt on cpt.co_seq_dim_competencia = tfpc.co_seq_dim_competencia
        where tdu.co_natureza_jur in ('1155','1031','1023')
    """, con=novo_ada
)

tb_tmp_prof_eas.to_sql(
    con=novo_ada,
    name='tb_tmp_prof_eas',
    schema=schema,
    index=False,
    if_exists='replace'
)

#prof_eas
prof_eas = pd.read_sql_query(
    """
    with
tmp_ult_fat_unidade_equipe_prof as ( 
    select * 
    from tb_fat_unidade_equipe_profissional tb 
    where tb.co_seq_dim_competencia = (select max(c.co_seq_dim_competencia) from tb_dim_competencia c)
), 
tmp_ult_fat_unidade_equipe as (
    select * 
    from tb_fat_unidade_equipe tb 
    where tb.co_seq_dim_competencia = (select max(c.co_seq_dim_competencia) from tb_dim_competencia c)
), 
tmp_tb_fat_equipe_tipoequipe as (
    select * 
    from tb_fat_equipe_tipoequipe tb
    where tb.co_seq_dim_competencia = (select max(c.co_seq_dim_competencia) from tb_dim_competencia c)
)
select distinct
    tpeas.dist_nome,
    tpeas.und_cnes, 
    tpeas.und_nome, 
    tpeas.prof_nome, 
    tpeas.prof_cpf, 
    tpeas.co_seq_dim_cbo, 
    tpeas.cbo_descricao, 
    tde.equi_ine,
    tde.equi_nome,
    tpeq.tpeq_descricao, 
    tfuep.und_eqp_prf_entrada, 
    tfuep.und_eqp_prf_saida, 
    tpeas.co_seq_dim_cargahoraria, 
    tpeas.cghorahosp, 
    tpeas.cghoraoutr, 
    cns.co_seq_cns::text as cns,
    co."DESCRICAO" as conselho, 
    tpeas.prof_numregistro, 
    tpeas.vinculo, 
    tpeas.vinculo_tipo, 
    tpeas.vinculo_subtipo,
    tpeas.desc_compet  
from tb_tmp_prof_eas tpeas
left join tb_dim_cns cns on cns.co_seq_dim_profissional::text = tpeas.co_seq_dim_profissional::text
left join tmp_ult_fat_unidade_equipe_prof tfuep on tfuep.co_seq_fat_profissional_cbo::text = tpeas.co_seq_fat_profissional_cbo::text  
    and tpeas.co_seq_dim_competencia::text = tfuep.co_seq_dim_competencia::text
left join tmp_ult_fat_unidade_equipe tfue on tfue.co_seq_fat_unidade_equipe::text = tfuep.co_seq_fat_unidade_equipe::text  
    and tfue.co_seq_dim_competencia::text = tpeas.co_seq_dim_competencia::text
left join tb_dim_equipe tde on tde.co_seq_dim_equipe::text = tfue.co_seq_dim_equipe::text
left join tmp_tb_fat_equipe_tipoequipe tpe on tpe.co_seq_dim_equipe::text = tde.co_seq_dim_equipe::text 
    and tpe.co_seq_dim_competencia::text = tpeas.co_seq_dim_competencia::text
left join tb_dim_tipoequipe tpeq on tpeq.co_seq_dim_tipo_equipe::text = tpe.co_seq_dim_tipo_equipe::text 
left join tb_dim_conselho co on co."CODORGEMIS" = tpeas.conselhoid 
order by 1,2,3
    """, con=novo_ada
)

prof_eas.to_sql(
    con=novo_ada,
    name='prof_eas',
    schema=schema,
    index=False,
    if_exists='replace'
)

##update tb_prof_status

#new_ada = sa.create_engine('postgresql+psycopg2://did:xfm32HFk6DMEwv9h@172.17.135.171:5432/serverdados?options=-csearch_path%3Dnovo_ada', echo=True).connect()

#tb_prof_status = pd.read_sql_query(
#    """
#    select
#        fpc.co_seq_dim_competencia,
#        und.und_cnes,
#        eq.co_seq_dim_equipe,
#        eq.equi_ine,
#        eq.equi_nome,
#        count(case when (cb.cbo_descricao like 'MEDICO%' or cb.cbo_descricao like 'MÉDICO%') and (fpc.co_seq_dim_cargahoraria >=20 and fpc.co_seq_dim_cargahoraria <40) then cb.cbo_descricao else null end) as c_med20,
#        count(case when (cb.cbo_descricao like 'MEDICO%' or cb.cbo_descricao like 'MÉDICO%') and (fpc.co_seq_dim_cargahoraria >=40) then fpc.co_seq_dim_cargahoraria else null end) as c_med40,
#        count(case when (cb.cbo_descricao like 'ENFERMEIRO%') and (fpc.co_seq_dim_cargahoraria >=20 and fpc.co_seq_dim_cargahoraria <30) then cb.cbo_descricao else null end) as c_enf20,
#        count(case when (cb.cbo_descricao like 'ENFERMEIRO%') and (fpc.co_seq_dim_cargahoraria >=30 and fpc.co_seq_dim_cargahoraria <40) then cb.cbo_descricao else null end) as c_enf30,
#        count(case when (cb.cbo_descricao like 'ENFERMEIRO%') and (fpc.co_seq_dim_cargahoraria >=40) then cb.cbo_descricao else null end) as c_enf40,
#        count(case when (cb.cbo_descricao like '%DENTISTA%') and (fpc.co_seq_dim_cargahoraria >=20 and fpc.co_seq_dim_cargahoraria <30) then cb.cbo_descricao else null end) as c_dent20,
#        count(case when (cb.cbo_descricao like '%DENTISTA%') and (fpc.co_seq_dim_cargahoraria >=30 and fpc.co_seq_dim_cargahoraria <40) then cb.cbo_descricao else null end) as c_dent30,
#        count(case when (cb.cbo_descricao like '%DENTISTA%') and (fpc.co_seq_dim_cargahoraria >=40) then cb.cbo_descricao else null end) as c_dent40,
#        count(case when (cb.cbo_descricao like '%DE BUCAL%') and (fpc.co_seq_dim_cargahoraria >=20 and fpc.co_seq_dim_cargahoraria <30) then cb.cbo_descricao else null end) as c_bucal20,
#        count(case when (cb.cbo_descricao like '%DE BUCAL%') and (fpc.co_seq_dim_cargahoraria >=30 and fpc.co_seq_dim_cargahoraria <40) then cb.cbo_descricao else null end) as c_bucal30,
#        count(case when (cb.cbo_descricao like '%DE BUCAL%') and (fpc.co_seq_dim_cargahoraria >=40) then cb.cbo_descricao else null end) as c_bucal40,
#        count(case when (cb.cbo_descricao like 'AUX%ENFERMAGEM%' or cb.cbo_descricao like '%CNICO%ENFERMAGEM%') then cb.cbo_descricao else null end) as c_tenf,
#        count(case when (cb.cbo_descricao like 'AGENTE%COM%SA%DE%') then cb.cbo_descricao else null end) as c_acs
#    from tb_fat_profissional_cbo fpc
#    join tb_dim_cbo cb on cb.co_seq_dim_cbo = fpc.co_seq_dim_cbo 
#    join tb_fat_unidade_equipe_profissional eqp on eqp.co_seq_fat_profissional_cbo = fpc.co_seq_fat_profissional_cbo and eqp.co_seq_dim_competencia = fpc.co_seq_dim_competencia 
#    join tb_fat_unidade_equipe unq on eqp.co_seq_fat_unidade_equipe = unq.co_seq_fat_unidade_equipe and unq.co_seq_dim_competencia = fpc.co_seq_dim_competencia 
#    join tb_dim_unidade und on und.co_seq_dim_unidade = unq.co_seq_dim_unidade 
#    join tb_dim_equipe eq on eq.co_seq_dim_equipe = unq.co_seq_dim_equipe 
#    join tb_fat_equipe_tipoequipe teq on teq.co_seq_dim_equipe = eq.co_seq_dim_equipe and teq.co_seq_dim_competencia = fpc.co_seq_dim_competencia 
#    join (select distinct cod_cbo, tipo_equipe from prof_equipe_min) eqm on eqm.cod_cbo = fpc.co_seq_dim_cbo and eqm.tipo_equipe = teq.co_seq_dim_tipo_equipe 
#    where eqp.und_eqp_prf_saida is null and fpc.co_seq_dim_competencia = (select max(c.co_seq_dim_competencia) from tb_dim_competencia c)
#    group by 1, 2, 3, 4
#    """,
#    con=new_ada
#)

#tb_prof_status.to_sql(
#    con=new_ada,
#    name='tb_prof_status',
#    schema=schema,
#    index=False,
#    if_exists='append'
#)

## select banco cnes

#tb_dim_distrito
tb_dim_distrito_cnes = pd.read_sql_query("""
                                            SELECT 
                                            CAST(l."CD_SEGMENTO" AS integer) AS "co_seq_dim_distrito", 
                                            l."DS_SEGMENTO" AS "dist_nome" 
                                            FROM "cnes"."LFCES040" l
                                            ORDER BY l."CD_SEGMENTO" 
                                         """,cnes_conn)

tb_dim_distrito_cnes = tb_dim_distrito_cnes.set_index('co_seq_dim_distrito')

pn.upsert(
    con=novo_ada,
    df=tb_dim_distrito_cnes,
    table_name='tb_dim_distrito',
    if_row_exists='update',
    dtype=None,
    chunksize=1000,
    create_table=False,
    schema=schema
)
#tb_dim_distrito_cnes = tb_dim_distrito_cnes.rename(columns={"cod_disa":"co_seq_dim_distrito","no_disa":"dist_nome"})
#tb_dim_distrito_cnes['co_seq_dim_distrito'] = tb_dim_distrito_cnes['co_seq_dim_distrito'].apply(lambda x: int(x))

#tb_dim_distrito_sd = pd.read_sql_query('select * from novo_ada.tb_dim_distrito',con=novo_ada)

#tb_dim_distrito = pd.concat([tb_dim_distrito_cnes,tb_dim_distrito_sd]).drop_duplicates(keep=False)

#tb_dim_distrito.to_sql(
#    con=novo_ada,
#    name='tb_dim_distrito',
#    schema=schema,
#    index=False,
#    if_exists='append'
#)

#tb_dim_unidade
tb_dim_unidade_cnes = pd.read_sql_query("""
                                            SELECT 
                                            l."UNIDADE_ID",
                                            l."CNES",
                                            l."NOME_FANTA",
                                            CAST(l."DIST_SANIT" AS integer) AS "DIST_SANIT", 
                                            l."CO_NATUREZA_JUR",
                                            l."CNPJ",
                                            l."NU_LATITUDE",
                                            l."NU_LONGITUDE"
                                            FROM "cnes"."LFCES004" l
                                            WHERE l."DIST_SANIT" IN ('00','01','02','03','04','05','06','07','08','09','06')
                                            AND l."CO_NATUREZA_JUR" in('1155','1031','1023')     
                                        """, cnes_conn)
tb_dim_unidade_cnes = tb_dim_unidade_cnes.rename(columns={"UNIDADE_ID":"co_seq_dim_unidade","CNES":"und_cnes","NOME_FANTA":"und_nome","DIST_SANIT":"co_seq_dim_distrito","CO_NATUREZA_JUR":"co_natureza_jur","CNPJ":"und_cnpj","NU_LATITUDE":"und_latitude","NU_LONGITUDE":"und_longitude"})
#tb_dim_unidade_cnes['co_seq_dim_distrito'].fillna('6',inplace=True)
tb_dim_unidade_cnes['co_seq_dim_unidade'] = tb_dim_unidade_cnes['co_seq_dim_unidade'].apply(lambda x: int(x))
#tb_dim_unidade_cnes['co_seq_dim_distrito'] = tb_dim_unidade_cnes['co_seq_dim_distrito'].apply(lambda x: int(x))

#tb_dim_unidade_sd = pd.read_sql_query('select * from novo_ada.tb_dim_unidade',con=novo_ada)

#tb_dim_unidade = tb_dim_unidade_cnes[~ tb_dim_unidade_cnes['und_cnes'].isin(tb_dim_unidade_sd['und_cnes'])]

#tb_dim_unidade.to_sql(
#    con=novo_ada,
#    name='tb_dim_unidade',
#    schema=schema,
#    index=False,
#    if_exists='append'  
#)
tb_dim_unidade_cnes = tb_dim_unidade_cnes.set_index('co_seq_dim_unidade')

pn.upsert(
    con=novo_ada,
    df=tb_dim_unidade_cnes,
    table_name='tb_dim_unidade',
    if_row_exists='update',
    dtype=None,
    chunksize=1000,
    create_table=False,
    schema=schema
)

#tb_fat_unidade_situacao
  
tb_fat_unidade_situacao = pd.read_sql_query("""
                                                select
                                                l."UNIDADE_ID" as "co_seq_dim_unidade", 
                                                n."DS_MOTIVO_DESAB" as "ds_motivo_desab",
                                                n2."DESCRICAO"  as "tipo_unidade"
                                                from novo_ada.lfces004 l
                                                left join novo_ada.nfces049 n on n."CD_MOTIVO_DESAB" = l."CD_MOTIVO_DESAB"
                                                join novo_ada.nfces010 n2 on n2."TP_UNID_ID" = l."TP_UNID_ID"
                                                WHERE l."DIST_SANIT" IN ('00','01','02','03','04','05','06','07','08','09','06')
                                                AND l."CO_NATUREZA_JUR" in('1155','1031','1023')
                                            """,con=novo_ada)

tb_fat_unidade_situacao['co_seq_dim_competencia'] = pd.Series(dtype='str')
tb_fat_unidade_situacao['co_seq_dim_competencia'].fillna(competenciaatual,inplace=True)

comp_unidade_situacao = tb_fat_unidade_situacao.pop('co_seq_dim_competencia')
tb_fat_unidade_situacao.insert(2,'co_seq_dim_competencia',comp_unidade_situacao)

comp_unidade_situacao = pd.read_sql_query('select max(co_seq_dim_competencia) from novo_ada.tb_fat_unidade_situacao', con=novo_ada)
comp_unidade_situacao = comp_unidade_situacao.loc[comp_unidade_situacao['max'] != '0']['max'].values[0]

if competenciaatual != comp_unidade_situacao:
    tb_fat_unidade_situacao.to_sql(
        con=novo_ada,
        name='tb_fat_unidade_situacao',
        schema=schema,
        index=False,
        if_exists='append'    
    )

#tb_dim_cbo
#mapcbo = {'1999A1':'199911','1999A2':'199912','2231A1':'223111','2231A2':'223112','5152A1':'515211','1312C1':'131231','2231F8':'223168','2231F9':'223169','2231G1':'223171','2235C3':'223533','2236I1':'223691','3135D1':'313541','3135D2':'313542','5151F1':'515161','2241E1':'224151'}
tb_dim_cbo_cnes = pd.read_sql_query('SELECT "COD_CBO","DESCRICAO" FROM "cnes"."NFCES026"',cnes_conn)
tb_dim_cbo_cnes = tb_dim_cbo_cnes.rename(columns={"COD_CBO":"co_seq_dim_cbo","DESCRICAO":"cbo_descricao"})
tb_dim_cbo_cnes['co_seq_dim_cbo'] = tb_dim_cbo_cnes['co_seq_dim_cbo'].map(lambda s: mapcbo.get(s) if s in mapcbo else s)
tb_dim_cbo_cnes['co_seq_dim_cbo'] = tb_dim_cbo_cnes['co_seq_dim_cbo'].astype(int)

tb_dim_cbo_sd = pd.read_sql_query('select * from novo_ada.tb_dim_cbo',con=novo_ada)
tb_dim_cbo = tb_dim_cbo_cnes[~ tb_dim_cbo_cnes['co_seq_dim_cbo'].isin(tb_dim_cbo_sd['co_seq_dim_cbo'])]

tb_dim_cbo.to_sql(
    con=novo_ada,
    name='tb_dim_cbo',
    schema=schema,
    index=False,
    if_exists='append'  
)

#tb_dim_cargahoraria
tb_dim_cargahoraria_cnes = pd.read_sql_query('SELECT DISTINCT "CG_HORAAMB" FROM "cnes"."LFCES021" ORDER BY "CG_HORAAMB" ASC', cnes_conn)
tb_dim_cargahoraria_cnes = tb_dim_cargahoraria_cnes.rename(columns={"CG_HORAAMB":"co_seq_dim_cargahoraria"})
tb_dim_cargahoraria_cnes['carg_quantidadehoras'] = tb_dim_cargahoraria_cnes['co_seq_dim_cargahoraria']

tb_dim_cargahoraria_sd = pd.read_sql_query('select * from novo_ada.tb_dim_cargahoraria',con=novo_ada)

tb_dim_cargahoraria = tb_dim_cargahoraria_cnes[~ tb_dim_cargahoraria_cnes['carg_quantidadehoras'].isin(tb_dim_cargahoraria_sd['carg_quantidadehoras'])]

tb_dim_cargahoraria.to_sql(
    con=novo_ada,
    name='tb_dim_cargahoraria',
    schema=schema,
    index=False,
    if_exists='append'
)

#dim_profissional
tb_dim_profissional_cnes = pd.read_sql_query('SELECT "PROF_ID","NOME_PROF","CPF_PROF" FROM "cnes"."LFCES018"',cnes_conn)
tb_dim_profissional_cnes = tb_dim_profissional_cnes.rename(columns={"PROF_ID":"co_seq_dim_profissional","NOME_PROF":"prof_nome","CPF_PROF":"prof_cpf"})

tb_dim_profissinal_sd = pd.read_sql_query('select * from novo_ada.tb_dim_profissional',con=novo_ada)

tb_dim_profissional = tb_dim_profissional_cnes[~ tb_dim_profissional_cnes['prof_cpf'].isin(tb_dim_profissinal_sd['prof_cpf'])]
tb_dim_profissional.to_sql(
    con=novo_ada,
    name='tb_dim_profissional',
    schema=schema,
    index=False,
    if_exists='append'  
)

#tb_dim_vinculo
tb_dim_vinculo_cnes = pd.read_sql_query('SELECT "IND_VINC", "DS_SUBVINCULO" FROM "cnes"."NFCES058"', cnes_conn)
tb_dim_vinculo_cnes = tb_dim_vinculo_cnes.rename(columns={"IND_VINC":"co_seq_fat_dim_vinculo", "DS_SUBVINCULO":"vinc_descricao"})
tb_dim_vinculo_cnes['co_seq_fat_dim_vinculo'] = tb_dim_vinculo_cnes['co_seq_fat_dim_vinculo'].astype(int)

tb_dim_vinculo_sd = pd.read_sql_query('select * from novo_ada.tb_dim_vinculo',con=novo_ada)

tb_dim_vinculo = tb_dim_vinculo_cnes[~ tb_dim_vinculo_cnes['co_seq_fat_dim_vinculo'].isin(tb_dim_vinculo_sd['co_seq_fat_dim_vinculo'])]

tb_dim_vinculo.to_sql(
    con=novo_ada,
    name='tb_dim_vinculo',
    schema=schema,
    index=False,
    if_exists='append'
)

#tb_dim_programas
tb_dim_programas_cnes = pd.read_sql_query('SELECT n."CO_ADESAO", n."DS_ADESAO", n."DT_VIGENCIA_INI", n."DT_VIGENCIA_FIM" FROM "cnes"."NFCES069" n', cnes_conn)
tb_dim_programas_cnes = tb_dim_programas_cnes.rename(columns={"CO_ADESAO":"co_seq_dim_programas","DS_ADESAO":"progund_nome","DT_VIGENCIA_INI":"progund_vig_inicio","DT_VIGENCIA_FIM":"progund_vig_fim"})
tb_dim_programas_cnes['co_seq_dim_programas'] = tb_dim_programas_cnes['co_seq_dim_programas'].astype(int)

tb_dim_programas_sd = pd.read_sql_query('select * from novo_ada.tb_dim_programas',con=novo_ada)

tb_dim_programas = tb_dim_programas_cnes[~ tb_dim_programas_cnes['co_seq_dim_programas'].isin(tb_dim_programas_sd['co_seq_dim_programas'])]

tb_dim_programas.to_sql(
    con=novo_ada,
    name='tb_dim_programas',
    schema=schema,
    index=False,
    if_exists='append'
)

#dim_tipo_equipe
tb_dim_tipoequipe_cnes = pd.read_sql_query('SELECT n."TP_EQUIPE", n."DS_EQUIPE" FROM "cnes"."NFCES046" n',cnes_conn)
tb_dim_tipoequipe_cnes = tb_dim_tipoequipe_cnes.rename(columns={"TP_EQUIPE":"co_seq_dim_tipo_equipe","DS_EQUIPE":"tpeq_descricao"})

tb_dim_tipoequipe_sd = pd.read_sql_query('select * from novo_ada.tb_dim_tipoequipe',con=novo_ada)

tb_dim_tipoequipe = tb_dim_tipoequipe_cnes[~ tb_dim_tipoequipe_cnes['tpeq_descricao'].isin(tb_dim_tipoequipe_sd['tpeq_descricao'])]

tb_dim_tipoequipe = tb_dim_tipoequipe.set_index('co_seq_dim_tipo_equipe')

pn.upsert(
    con=novo_ada,
    df=tb_dim_tipoequipe,
    table_name='tb_dim_tipoequipe',
    if_row_exists='update',
    dtype=None,
    chunksize=1000,
    create_table=False,
    schema=schema
)

#tb_dim_equipe
tb_dim_equipe_cnes = pd.read_sql_query('SELECT l."CO_EQUIPE",l2."INE",l."NM_REFERENCIA", l2."DS_AREA" FROM "cnes"."LFCES037" l left join "cnes"."LFCES060" l2 on l2."SEQ_EQUIPE" = l."SEQ_EQUIPE"',cnes_conn) #LFCES060 LFCES037
tb_dim_equipe_cnes = tb_dim_equipe_cnes.rename(columns={"CO_EQUIPE":"co_seq_dim_equipe","INE":"equi_ine","NM_REFERENCIA":"equi_nome","DS_AREA":"equi_area"})
tb_dim_equipe_cnes['equi_ine'].fillna('desativada',inplace=True)
tb_dim_equipe_cnes['equi_area'].fillna('desativada',inplace=True)
tb_dim_equipe_cnes['co_seq_dim_equipe'] = tb_dim_equipe_cnes['co_seq_dim_equipe'].astype('int64')

tb_dim_equipe_sd = pd.read_sql_query('select * from novo_ada.tb_dim_equipe',con=novo_ada)

tb_dim_equipe = pd.merge(tb_dim_equipe_cnes, tb_dim_equipe_sd, how='outer',indicator='Exist')
tb_dim_equipe = tb_dim_equipe.loc[tb_dim_equipe['Exist'] != 'both']
tb_dim_equipe = tb_dim_equipe.loc[tb_dim_equipe['Exist'] != 'right_only']
tb_dim_equipe = tb_dim_equipe.drop('Exist',axis=1)

tb_dim_equipe = tb_dim_equipe.set_index('co_seq_dim_equipe')

pn.upsert(
    con=novo_ada,
    df=tb_dim_equipe,
    table_name='tb_dim_equipe',
    if_row_exists='update',
    dtype=None,
    chunksize=1000,
    create_table=False,
    schema=schema
)

#tb_fat_portaria_equipe
tb_fat_portaria_equipe = pd.read_sql_query('SELECT co_seq_dim_portarias, co_seq_dim_equipe, tb_fat_portaria_desc, port_desc_tipo_homolog FROM novo_ada.tb_fat_portaria_equipe where co_seq_dim_competencia = 37;',con=novo_ada)
tb_fat_portaria_equipe['co_seq_dim_competencia'] = pd.Series(dtype='str')
tb_fat_portaria_equipe['co_seq_dim_competencia'].fillna(competenciaatual,inplace=True)

comp_portaria_equipe = tb_fat_portaria_equipe.pop('co_seq_dim_competencia')
tb_fat_portaria_equipe.insert(2,'co_seq_dim_competencia',comp_portaria_equipe)

comp_portaria_equipe = pd.read_sql_query('select max(co_seq_dim_competencia) from novo_ada.tb_fat_portaria_equipe', con=novo_ada)
comp_portaria_equipe = comp_portaria_equipe.loc[comp_portaria_equipe['max'] != '0']['max'].values[0]

if competenciaatual != comp_portaria_equipe:
    tb_fat_portaria_equipe.to_sql(
        con=novo_ada,
        name='tb_fat_portaria_equipe',
        schema=schema,
        index=False,
        if_exists='append'    
    )

#tb_dim_cns
tb_dim_cns_cnes = pd.read_sql_query('select l."COD_CNS" , l."PROF_ID" from "cnes"."LFCES018" l', cnes_conn)
tb_dim_cns_cnes = tb_dim_cns_cnes.rename(columns={"COD_CNS":'co_seq_cns', "PROF_ID":"co_seq_dim_profissional"})
tb_dim_cns_cnes['co_seq_cns'] = tb_dim_cns_cnes['co_seq_cns'].astype('int64')
tb_dim_cns_cnes['co_seq_dim_profissional'] = tb_dim_cns_cnes['co_seq_dim_profissional'].astype('int64')

tb_dim_cns_sd = pd.read_sql_query('select co_seq_cns, co_seq_dim_profissional from novo_ada.tb_dim_cns',con=novo_ada)

tb_dim_cns = pd.merge(tb_dim_cns_cnes, tb_dim_cns_sd, how='outer',indicator='Exist')
tb_dim_cns = tb_dim_cns.loc[tb_dim_cns['Exist'] != 'both']
tb_dim_cns = tb_dim_cns.loc[tb_dim_cns['Exist'] != 'right_only']
tb_dim_cns = tb_dim_cns.drop('Exist',axis=1)

tb_dim_cns = tb_dim_cns.set_index('co_seq_cns')

pn.upsert(
    con=novo_ada,
    df=tb_dim_cns,
    table_name='tb_dim_cns',
    if_row_exists='update',
    dtype=None,
    chunksize=1000,
    create_table=False,
    schema=schema
)

#tb_fat_unidade_equipe
tb_fat_unidade_equipe = pd.read_sql_query('SELECT "UNIDADE_ID","CO_EQUIPE","DT_ATIVACAO","DT_DESATIVACAO" FROM "cnes"."LFCES037"',cnes_conn)
tb_fat_unidade_equipe = tb_fat_unidade_equipe.rename(columns={"UNIDADE_ID":"co_seq_dim_unidade","CO_EQUIPE":"co_seq_dim_equipe","DT_ATIVACAO":"unid_equi_data_ativ","DT_DESATIVACAO":"unid_equi_data_desat"})
tb_fat_unidade_equipe['co_seq_dim_unidade'] = tb_fat_unidade_equipe['co_seq_dim_unidade'].astype('int64')
tb_fat_unidade_equipe['co_seq_dim_equipe'] = tb_fat_unidade_equipe['co_seq_dim_equipe'].astype('int64')
#tb_fat_unidade_equipe['unid_equi_data_desat'].fillna('ativa',inplace=True)
tb_fat_unidade_equipe['co_seq_dim_competencia'] = pd.Series(dtype='str')
tb_fat_unidade_equipe['co_seq_dim_competencia'].fillna(competenciaatual,inplace=True)
tb_fat_unidade_equipe['co_seq_dim_competencia'] = tb_fat_unidade_equipe['co_seq_dim_competencia'].astype('int64')

comp_unidade_equipe = pd.read_sql_query('select max(co_seq_dim_competencia) from novo_ada.tb_fat_unidade_equipe', con=novo_ada)
comp_unidade_equipe = comp_unidade_equipe.loc[comp_unidade_equipe['max'] != '0']['max'].values[0]

if competenciaatual != comp_unidade_equipe:
    tb_fat_unidade_equipe.to_sql(
        con=novo_ada,
        name='tb_fat_unidade_equipe',
        schema=schema,
        index=False,
        if_exists='append'    
    )

#tb_fat_profissional_cbo
tb_fat_profissinal_cbo = pd.read_sql_query("""
                                            SELECT "PROF_ID","COD_CBO",
                                            "N_REGISTRO","IND_VINC",
                                            "CG_HORAAMB","UNIDADE_ID", 
                                            "NU_CNPJ_DET_VINC", 
                                            Left("IND_VINC",2) as "COD_VINC",  Left((Right("IND_VINC",4)),2) as "TP_VINC", "CGHORAHOSP", "CGHORAOUTR", "CONSELHOID" FROM "cnes"."LFCES021"

                                            """, cnes_conn)
tb_fat_profissinal_cbo = tb_fat_profissinal_cbo.rename(columns={"PROF_ID":"co_seq_dim_profissional","COD_CBO":"co_seq_dim_cbo","N_REGISTRO":"prof_numregistro","IND_VINC":"co_seq_fat_dim_vinculo","CG_HORAAMB":"co_seq_dim_cargahoraria","UNIDADE_ID":"unidade_id","NU_CNPJ_DET_VINC":"nu_cnpj_det_vinc","COD_VINC":"cod_vinc","TP_VINC":"tp_vinc","CGHORAHOSP":"cghorahosp", "CGHORAOUTR":"cghoraoutr","CONSELHOID":"conselhoid"})
tb_fat_profissinal_cbo['co_seq_dim_competencia'] = pd.Series(dtype='str')
tb_fat_profissinal_cbo['co_seq_dim_competencia'].fillna(competenciaatual,inplace=True)
tb_fat_profissinal_cbo['co_seq_dim_cbo'] = tb_fat_profissinal_cbo['co_seq_dim_cbo'].map(lambda s: mapcbo.get(s) if s in mapcbo else s)

comp_fat_profissional_cbo = pd.read_sql_query('select max(co_seq_dim_competencia) from novo_ada.tb_fat_profissional_cbo', con=novo_ada)
comp_fat_profissional_cbo = comp_fat_profissional_cbo.loc[comp_fat_profissional_cbo['max'] != '0']['max'].values[0]

comp = tb_fat_profissinal_cbo.pop('co_seq_dim_competencia')
tb_fat_profissinal_cbo.insert(5,'co_seq_dim_competencia',comp)

if competenciaatual != comp_fat_profissional_cbo:
    tb_fat_profissinal_cbo.to_sql(
        con=novo_ada,
        name='tb_fat_profissional_cbo',
        schema=schema,
        index=False,
        if_exists='append'    
    )

#tb_fat_unidade_equipe_profissional
#tb_fat_unidade_equipe_profissional = pd.read_sql_query('select tfpc.co_seq_fat_profissional_cbo, tfue.co_seq_fat_unidade_equipe, l."DT_ENTRADA", l."DT_DESLIGAMENTO" from novo_ada.lfces038 l join novo_ada.tb_fat_profissional_cbo tfpc on tfpc.co_seq_dim_profissional = l."PROF_ID" join novo_ada.tb_fat_unidade_equipe tfue on tfue.co_seq_dim_equipe = l."SEQ_EQUIPE" where tfue.co_seq_dim_competencia = (select max(ue.co_seq_dim_competencia) from novo_ada.tb_fat_unidade_equipe ue) and tfpc.co_seq_dim_competencia = (select max(pc.co_seq_dim_competencia) from novo_ada.tb_fat_profissional_cbo pc);',novo_ada)
tb_fat_unidade_equipe_profissional = pd.read_sql_query('select tfpc.co_seq_fat_profissional_cbo, tfue.co_seq_fat_unidade_equipe, l."DT_ENTRADA", l."DT_DESLIGAMENTO" from novo_ada.lfces038 l join novo_ada.lfces037 le on (le."COD_MUN" = l."COD_MUN") AND (le."COD_AREA" = l."COD_AREA") AND (le."SEQ_EQUIPE" = l."SEQ_EQUIPE") AND (le."UNIDADE_ID" = l."UNIDADE_ID") join novo_ada.tb_fat_profissional_cbo tfpc on tfpc.co_seq_dim_profissional = l."PROF_ID" and tfpc.co_seq_fat_dim_vinculo = l."IND_VINC"::integer and tfpc.co_seq_dim_cbo  = l."COD_CBO"::integer and tfpc.unidade_id = l."UNIDADE_ID" join novo_ada.tb_fat_unidade_equipe tfue on tfue.co_seq_dim_equipe = l."SEQ_EQUIPE" where tfue.co_seq_dim_competencia = (select max(ue.co_seq_dim_competencia) from novo_ada.tb_fat_unidade_equipe ue) and tfpc.co_seq_dim_competencia = (select max(pc.co_seq_dim_competencia) from novo_ada.tb_fat_profissional_cbo pc)',novo_ada)
tb_fat_unidade_equipe_profissional = tb_fat_unidade_equipe_profissional.rename(columns={"DT_ENTRADA":"und_eqp_prf_entrada","DT_DESLIGAMENTO":"und_eqp_prf_saida"})
tb_fat_unidade_equipe_profissional['co_seq_dim_competencia'] = pd.Series(dtype='str')
tb_fat_unidade_equipe_profissional['co_seq_dim_competencia'].fillna(competenciaatual,inplace=True)
tb_fat_unidade_equipe_profissional['co_seq_dim_competencia'] = tb_fat_unidade_equipe_profissional['co_seq_dim_competencia'].astype('int64')

comp_unidade_equipe_profissional = pd.read_sql_query('select max(co_seq_dim_competencia) from novo_ada.tb_fat_unidade_equipe_profissional', con=novo_ada)
comp_unidade_equipe_profissional = comp_unidade_equipe_profissional.loc[comp_unidade_equipe_profissional['max'] != '0']['max'].values[0]

comp = tb_fat_unidade_equipe_profissional.pop('co_seq_dim_competencia')

tb_fat_unidade_equipe_profissional.insert(4,'co_seq_dim_competencia',comp)

if competenciaatual != comp_unidade_equipe_profissional:
    tb_fat_unidade_equipe_profissional.to_sql(
        con=novo_ada,
        name='tb_fat_unidade_equipe_profissional',
        schema=schema,
        index=False,
        if_exists='append'    
    )

#tb_fat_equipe_tipoequipe
tb_fat_equipe_tipoequipe = pd.read_sql_query('SELECT l."SEQ_EQUIPE", l."TP_EQUIPE" FROM "cnes"."LFCES037" l', cnes_conn)
tb_fat_equipe_tipoequipe = tb_fat_equipe_tipoequipe.rename(columns={"SEQ_EQUIPE":"co_seq_dim_equipe","TP_EQUIPE":"co_seq_dim_tipo_equipe"})
tb_fat_equipe_tipoequipe['co_seq_dim_competencia'] = pd.Series(dtype='str')
tb_fat_equipe_tipoequipe['co_seq_dim_competencia'].fillna(competenciaatual,inplace=True)

comp_equipe_tipoequipe = pd.read_sql_query('select max(co_seq_dim_competencia) from novo_ada.tb_fat_equipe_tipoequipe', con=novo_ada)
comp_equipe_tipoequipe = comp_equipe_tipoequipe.loc[comp_equipe_tipoequipe['max'] != '0']['max'].values[0]

if competenciaatual != comp_equipe_tipoequipe:
    tb_fat_equipe_tipoequipe.to_sql(
        con=novo_ada,
        name='tb_fat_equipe_tipoequipe',
        schema=schema,
        index=False,
        if_exists='append'    
    )


#tb_fat_unidade_programas
tb_fat_unidade_programas = pd.read_sql_query("""
                                            SELECT l."UNIDADE_ID", l."CO_ADESAO" FROM "cnes"."LFCES072" l
                                            join "cnes"."LFCES004" l4 on l4."UNIDADE_ID" = l."UNIDADE_ID"
                                            WHERE l4."DIST_SANIT" IN ('00','01','02','03','04','05','06','07','08','09','06')
                                            AND l4."CO_NATUREZA_JUR" in('1155','1031','1023')
                                            """,cnes_conn)
tb_fat_unidade_programas = tb_fat_unidade_programas.rename(columns={"UNIDADE_ID":"co_seq_dim_unidade", "CO_ADESAO":"co_seq_dim_programas"})
tb_fat_unidade_programas['co_seq_dim_competencia'] = pd.Series(dtype='str')
tb_fat_unidade_programas['co_seq_dim_competencia'].fillna(competenciaatual,inplace=True)

comp_unidade_programas = pd.read_sql_query('select max(co_seq_dim_competencia) from novo_ada.tb_fat_unidade_programas', con=novo_ada)
comp_unidade_programas = comp_unidade_programas.loc[comp_unidade_programas['max'] != '0']['max'].values[0]

if competenciaatual != comp_unidade_programas:
    tb_fat_unidade_programas.to_sql(
        con=novo_ada,
        name='tb_fat_unidade_programas',
        schema=schema,
        index=False,
        if_exists='append'    
    )


#tb_fat_equipe_equipe
tb_fat_equipe_equipe = pd.read_sql_query('select l."SEQ_EQUIPE_ESF" as co_seq_dim_equipe, l."SEQ_EQUIPE" as co_seq_dim_equipe_esb from novo_ada.lfces059 l where l."SEQ_EQUIPE" in (select distinct co_seq_dim_equipe from novo_ada.tb_dim_equipe tde) and l."SEQ_EQUIPE_ESF" in (select distinct co_seq_dim_equipe from novo_ada.tb_dim_equipe tde)',con=novo_ada)
tb_fat_equipe_equipe['co_seq_dim_competencia'] = pd.Series(dtype='str')
tb_fat_equipe_equipe['co_seq_dim_competencia'].fillna(competenciaatual,inplace=True)

comp_equipe_equipe = pd.read_sql_query('select max(co_seq_dim_competencia) from novo_ada.tb_fat_equipe_equipe', con=novo_ada)
comp_equipe_equipe = comp_equipe_equipe.loc[comp_equipe_equipe['max'] != '0']['max'].values[0]

if competenciaatual != comp_equipe_equipe:
    tb_fat_equipe_equipe.to_sql(
        con=novo_ada,
        name='tb_fat_equipe_equipe',
        schema=schema,
        index=False,
        if_exists='append'    
    )

cnes_conn.close()
novo_ada.commit()
novo_ada.close()                                   
