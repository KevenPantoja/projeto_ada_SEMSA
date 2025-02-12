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
novo_ada = sa.create_engine('postgresql+psycopg2://did:xfm32HFk6DMEwv9h@172.17.135.171:5432/serverdados', echo=True).connect()

tb_tmp_prof_eas = pd.read_sql_query(
    """
        SET search_path TO novo_ada;

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

print(tb_tmp_prof_eas)