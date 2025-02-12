--
--profissionais em equipes no cnes
--
select distinct tdu.und_nome, tde.equi_nome, tdp.prof_nome, tdc2.cbo_descricao, tdc3.carg_quantidadehoras, tdv.vinc_descricao from tb_dim_unidade tdu
join tb_fat_unidade_equipe tfue on tfue.co_seq_dim_unidade = tdu.co_seq_dim_unidade 
join tb_fat_unidade_equipe_profissional tfuep on tfuep.co_seq_fat_unidade_equipe = tfue.co_seq_fat_unidade_equipe
join tb_fat_profissional_cbo tfpc on tfpc.co_seq_fat_profissional_cbo = tfuep.co_seq_fat_profissional_cbo
join tb_dim_profissional tdp on tdp.co_seq_dim_profissional = tfpc.co_seq_dim_profissional
join tb_dim_equipe tde on tde.co_seq_dim_equipe = tfue.co_seq_dim_equipe
join tb_dim_cns tdc on tdc.co_seq_dim_profissional = tdp.co_seq_dim_profissional
join tb_dim_cbo tdc2 on tdc2.co_seq_dim_cbo = tfpc.co_seq_dim_cbo
join tb_dim_cargahoraria tdc3 on tdc3.co_seq_dim_cargahoraria =tfpc.co_seq_dim_cargahoraria
join tb_dim_vinculo tdv on tdv.co_seq_fat_dim_vinculo = tfpc.co_seq_fat_dim_vinculo 
and tfue.co_seq_dim_competencia = 6
order by 1,2,3 


--profissionais por CBO

select distinct count(tfpc.co_seq_dim_profissional), tdc.cbo_descricao from tb_dim_cbo tdc
join tb_fat_profissional_cbo tfpc on tfpc.co_seq_dim_cbo = tdc.co_seq_dim_cbo
join tb_fat_unidade_equipe_profissional tfuep on tfuep.co_seq_fat_profissional_cbo = tfpc.co_seq_fat_profissional_cbo
join tb_fat_unidade_equipe tfue on tfue.co_seq_fat_unidade_equipe = tfuep.co_seq_fat_unidade_equipe
join tb_dim_unidade tdu on tdu.co_seq_dim_unidade = tfue.co_seq_dim_unidade
join tb_dim_distrito tdd on tdd.co_seq_dim_distrito = tdu.co_seq_dim_distrito
where tdd.co_seq_dim_distrito <> 6
and tdd.co_seq_dim_distrito <> 0
and tfpc.co_seq_dim_competencia = 6
group by 2
order by 2


--cenario equipes

select tdu.und_nome, tde.equi_ine, tde.equi_nome, tdt.tpeq_descricao, tfue.unid_equi_data_ativ, tfue.unid_equi_data_desat from tb_dim_unidade tdu
join tb_fat_unidade_equipe tfue on tfue.co_seq_dim_unidade = tdu.co_seq_dim_unidade 
join tb_dim_equipe tde on tde.co_seq_dim_equipe = tfue.co_seq_dim_equipe
join tb_fat_equipe_tipoequipe tfet on tfet.co_seq_dim_equipe = tde.co_seq_dim_equipe
join tb_dim_tipoequipe tdt on tdt.co_seq_dim_tipo_equipe = tfet.co_seq_dim_tipo_equipe 

--filtros aplicados
select tdd.dist_nome, count(tdu.co_seq_dim_unidade) from tb_dim_unidade tdu
join tb_dim_distrito tdd on tdd.co_seq_dim_distrito = tdu.co_seq_dim_distrito 
where tdu.co_seq_dim_distrito <> 6
and tdu.co_seq_dim_distrito <> 0
group by 1

--informações gerais
select count(tdu.und_nome), tdp.progund_nome from tb_dim_unidade tdu 
join tb_fat_unidade_programas tfup on tfup.co_seq_dim_unidade = tdu.co_seq_dim_unidade
join tb_dim_programas tdp on tdp.co_seq_dim_programas = tfup.co_seq_dim_programas
group by 2
