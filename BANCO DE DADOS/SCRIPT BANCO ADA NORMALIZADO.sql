
CREATE TABLE tb_dim_cargahoraria
(
  co_seq_dim_cargahoraria int NOT NULL,
  carg_quantidadehoras    int NOT NULL,
  PRIMARY KEY (co_seq_dim_cargahoraria)
);

COMMENT ON TABLE tb_dim_cargahoraria IS 'armazena carga horaria';

COMMENT ON COLUMN tb_dim_cargahoraria.co_seq_dim_cargahoraria IS 'PK tb_dim_cargahoraria';

COMMENT ON COLUMN tb_dim_cargahoraria.carg_quantidadehoras IS 'carga horaria semanal';

CREATE TABLE tb_dim_cbo
(
  co_seq_dim_cbo bigint  NOT NULL,
  cbo_descricao  varchar NOT NULL,
  PRIMARY KEY (co_seq_dim_cbo)
);

COMMENT ON COLUMN tb_dim_cbo.co_seq_dim_cbo IS 'PK tb_dim_cbo';

COMMENT ON COLUMN tb_dim_cbo.cbo_descricao IS 'descrição do cbo';

CREATE TABLE tb_dim_cns
(
  co_seq_cns              bigint NOT NULL,
  co_seq_dim_profissional bigint NOT NULL,
  PRIMARY KEY (co_seq_cns)
);

COMMENT ON TABLE tb_dim_cns IS 'armazena cns do profissional';

COMMENT ON COLUMN tb_dim_cns.co_seq_cns IS 'PK tb_dim_cns';

COMMENT ON COLUMN tb_dim_cns.co_seq_dim_profissional IS 'PK tb_dim_profissional';

CREATE TABLE tb_dim_competencia
(
  co_seq_dim_competencia bigint    NOT NULL GENERATED ALWAYS AS IDENTITY,
  comp_competencia       INT       NOT NULL,
  comp_valido            boolean   NOT NULL,
  comp_data              timestamp,
  PRIMARY KEY (co_seq_dim_competencia)
);

COMMENT ON TABLE tb_dim_competencia IS 'registra as competencias do cnes';

COMMENT ON COLUMN tb_dim_competencia.co_seq_dim_competencia IS 'PK tb_dim_competencia';

COMMENT ON COLUMN tb_dim_competencia.comp_competencia IS 'tipo da competencia';

COMMENT ON COLUMN tb_dim_competencia.comp_valido IS 'competencia valida ou não';

COMMENT ON COLUMN tb_dim_competencia.comp_data IS 'registra fechamento competencia';

CREATE TABLE tb_dim_distrito
(
  co_seq_dim_distrito bigint  NOT NULL,
  dist_nome           varchar NOT NULL,
  PRIMARY KEY (co_seq_dim_distrito)
);

COMMENT ON TABLE tb_dim_distrito IS 'armazena distrito de saúde';

COMMENT ON COLUMN tb_dim_distrito.co_seq_dim_distrito IS 'PK tb_dim_distrito';

COMMENT ON COLUMN tb_dim_distrito.dist_nome IS 'nome do distrito';

CREATE TABLE tb_dim_equipe
(
  co_seq_dim_equipe bigint  NOT NULL,
  equi_ine          VARCHAR NOT NULL,
  equi_nome         VARCHAR NOT NULL,
  equi_area         varchar,
  PRIMARY KEY (co_seq_dim_equipe)
);

COMMENT ON TABLE tb_dim_equipe IS 'armazena dados referentes a equipe';

COMMENT ON COLUMN tb_dim_equipe.co_seq_dim_equipe IS 'PK tb_dim_equipe';

COMMENT ON COLUMN tb_dim_equipe.equi_ine IS 'ine da equipe';

COMMENT ON COLUMN tb_dim_equipe.equi_nome IS 'nome da equipe';

COMMENT ON COLUMN tb_dim_equipe.equi_area IS 'area da equipe';

CREATE TABLE tb_dim_portarias
(
  co_seq_dim_portarias bigint  NOT NULL,
  portaria_nome        varchar NOT NULL,
  PRIMARY KEY (co_seq_dim_portarias)
);

CREATE TABLE tb_dim_profissional
(
  co_seq_dim_profissional bigint  NOT NULL,
  prof_nome               VARCHAR NOT NULL,
  prof_cpf                VARCHAR NOT NULL,
  PRIMARY KEY (co_seq_dim_profissional)
);

COMMENT ON TABLE tb_dim_profissional IS 'armazena dados referentes ao profissional';

COMMENT ON COLUMN tb_dim_profissional.co_seq_dim_profissional IS 'PK tb_dim_profissional';

COMMENT ON COLUMN tb_dim_profissional.prof_nome IS 'nome do profissional';

COMMENT ON COLUMN tb_dim_profissional.prof_cpf IS 'cpf do profissional';

CREATE TABLE tb_dim_programas
(
  co_seq_dim_programas bigint  NOT NULL,
  progund_nome         varchar NOT NULL,
  progund_vig_inicio   varchar,
  progund_vig_fim      varchar,
  PRIMARY KEY (co_seq_dim_programas)
);

COMMENT ON TABLE tb_dim_programas IS 'armazena informações referentes aos programas de saúde';

COMMENT ON COLUMN tb_dim_programas.co_seq_dim_programas IS 'PK tb_dim_programas';

COMMENT ON COLUMN tb_dim_programas.progund_nome IS 'armazena nome do programa';

COMMENT ON COLUMN tb_dim_programas.progund_vig_inicio IS 'armazena data de inicio do programa';

COMMENT ON COLUMN tb_dim_programas.progund_vig_fim IS 'armazena data de fim do programa';

CREATE TABLE tb_dim_tipoequipe
(
  co_seq_dim_tipo_equipe bigint  NOT NULL,
  tpeq_descricao         varchar NOT NULL,
  PRIMARY KEY (co_seq_dim_tipo_equipe)
);

COMMENT ON TABLE tb_dim_tipoequipe IS 'tipos das equipes';

COMMENT ON COLUMN tb_dim_tipoequipe.co_seq_dim_tipo_equipe IS 'PK tb_dim_tipo_equipe';

COMMENT ON COLUMN tb_dim_tipoequipe.tpeq_descricao IS 'descrição da equipe';

CREATE TABLE tb_dim_unidade
(
  co_seq_dim_unidade  bigint  NOT NULL,
  und_cnes            varchar NOT NULL,
  und_nome            varchar NOT NULL,
  co_seq_dim_distrito bigint  NOT NULL,
  und_cnpj            varchar,
  und_latitude        varchar,
  und_longitude       varchar,
  PRIMARY KEY (co_seq_dim_unidade)
);

COMMENT ON TABLE tb_dim_unidade IS 'armazena dados referentes a unidade de saude';

COMMENT ON COLUMN tb_dim_unidade.co_seq_dim_unidade IS 'PK tb_dim_unidade';

COMMENT ON COLUMN tb_dim_unidade.und_cnes IS 'cnes da unidade de saúde';

COMMENT ON COLUMN tb_dim_unidade.und_nome IS 'nome da unidade de saúde';

COMMENT ON COLUMN tb_dim_unidade.co_seq_dim_distrito IS 'FK referencia tb_dim_distrito';

COMMENT ON COLUMN tb_dim_unidade.und_cnpj IS 'cnpj da unidade';

COMMENT ON COLUMN tb_dim_unidade.und_latitude IS 'latitude da unidade';

COMMENT ON COLUMN tb_dim_unidade.und_longitude IS 'longitude da unidade';

CREATE TABLE tb_dim_vinculo
(
  co_seq_fat_dim_vinculo int     NOT NULL,
  vinc_descricao         varchar NOT NULL,
  PRIMARY KEY (co_seq_fat_dim_vinculo)
);

COMMENT ON TABLE tb_dim_vinculo IS 'armazena dados referente ao vinculo profissional';

COMMENT ON COLUMN tb_dim_vinculo.co_seq_fat_dim_vinculo IS 'PK tb_dim_vinculo';

COMMENT ON COLUMN tb_dim_vinculo.vinc_descricao IS 'tipo do vinculo';

CREATE TABLE tb_fat_equipe_equipe
(
  co_seq_fat_equipe_equipe bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  co_seq_dim_equipe        bigint NOT NULL,
  co_seq_dim_equipe_esb    bigint NOT NULL,
  co_seq_dim_competencia   bigint NOT NULL,
  PRIMARY KEY (co_seq_fat_equipe_equipe)
);

COMMENT ON COLUMN tb_fat_equipe_equipe.co_seq_dim_equipe IS 'PK tb_dim_equipe';

COMMENT ON COLUMN tb_fat_equipe_equipe.co_seq_dim_equipe_esb IS 'PK tb_dim_equipe';

COMMENT ON COLUMN tb_fat_equipe_equipe.co_seq_dim_competencia IS 'PK tb_dim_competencia';

CREATE TABLE tb_fat_equipe_tipoequipe
(
  co_seq_fat_equipe_tipoequipe bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  co_seq_dim_equipe            bigint NOT NULL,
  co_seq_dim_tipo_equipe       bigint NOT NULL,
  co_seq_dim_competencia       bigint NOT NULL,
  PRIMARY KEY (co_seq_fat_equipe_tipoequipe)
);

COMMENT ON COLUMN tb_fat_equipe_tipoequipe.co_seq_fat_equipe_tipoequipe IS 'PK tb_fat_equipe_tipoequipe';

COMMENT ON COLUMN tb_fat_equipe_tipoequipe.co_seq_dim_equipe IS 'PK tb_dim_equipe';

COMMENT ON COLUMN tb_fat_equipe_tipoequipe.co_seq_dim_tipo_equipe IS 'PK tb_dim_tipo_equipe';

COMMENT ON COLUMN tb_fat_equipe_tipoequipe.co_seq_dim_competencia IS 'PK tb_dim_competencia';

CREATE TABLE tb_fat_portaria_equipe
(
  co_seq_fat_portaria_equipe bigint  NOT NULL GENERATED ALWAYS AS IDENTITY,
  co_seq_dim_portarias       bigint  NOT NULL,
  co_seq_dim_equipe          bigint  NOT NULL,
  co_seq_dim_competencia     bigint  NOT NULL,
  tb_fat_portaria_desc       varchar NOT NULL,
  PRIMARY KEY (co_seq_fat_portaria_equipe)
);

COMMENT ON COLUMN tb_fat_portaria_equipe.co_seq_dim_equipe IS 'PK tb_dim_equipe';

COMMENT ON COLUMN tb_fat_portaria_equipe.co_seq_dim_competencia IS 'PK tb_dim_competencia';

CREATE TABLE tb_fat_profissional_cbo
(
  co_seq_fat_profissional_cbo bigint  NOT NULL GENERATED ALWAYS AS IDENTITY,
  co_seq_dim_profissional     bigint  NOT NULL,
  co_seq_dim_cbo              bigint  NOT NULL,
  prof_numregistro            varchar NOT NULL,
  co_seq_fat_dim_vinculo      int     NOT NULL,
  co_seq_dim_cargahoraria     int     NOT NULL,
  co_seq_dim_competencia      bigint  NOT NULL,
  PRIMARY KEY (co_seq_fat_profissional_cbo)
);

COMMENT ON COLUMN tb_fat_profissional_cbo.co_seq_fat_profissional_cbo IS 'PK tb_fat_profissional_cbo';

COMMENT ON COLUMN tb_fat_profissional_cbo.co_seq_dim_profissional IS 'FK referencia tb_dim_profissional';

COMMENT ON COLUMN tb_fat_profissional_cbo.co_seq_dim_cbo IS 'FK referencia tb_dim_cbo';

COMMENT ON COLUMN tb_fat_profissional_cbo.prof_numregistro IS 'numero registro profissional';

COMMENT ON COLUMN tb_fat_profissional_cbo.co_seq_fat_dim_vinculo IS 'FK referencia dim_vinculo';

COMMENT ON COLUMN tb_fat_profissional_cbo.co_seq_dim_cargahoraria IS 'PK tb_dim_cargahoraria';

COMMENT ON COLUMN tb_fat_profissional_cbo.co_seq_dim_competencia IS 'FK referencia dim_competencia';

CREATE TABLE tb_fat_unidade_equipe
(
  co_seq_fat_unidade_equipe bigint  NOT NULL GENERATED ALWAYS AS IDENTITY,
  co_seq_dim_unidade        bigint  NOT NULL,
  co_seq_dim_equipe         bigint  NOT NULL,
  unid_equi_data_ativ       varchar NOT NULL,
  unid_equi_data_desat      varchar NOT NULL,
  co_seq_dim_competencia    bigint  NOT NULL,
  PRIMARY KEY (co_seq_fat_unidade_equipe)
);

COMMENT ON COLUMN tb_fat_unidade_equipe.co_seq_dim_unidade IS 'PK tb_dim_unidade';

COMMENT ON COLUMN tb_fat_unidade_equipe.co_seq_dim_equipe IS 'PK tb_dim_equipe';

COMMENT ON COLUMN tb_fat_unidade_equipe.unid_equi_data_ativ IS 'armazena data de ativação ou desativação da equipe';

COMMENT ON COLUMN tb_fat_unidade_equipe.unid_equi_data_desat IS 'sinaliza ativação ou desativação da equipe';

COMMENT ON COLUMN tb_fat_unidade_equipe.co_seq_dim_competencia IS 'PK tb_dim_competencia';

CREATE TABLE tb_fat_unidade_equipe_profissional
(
  co_seq_tb_fat_equipe_profissional bigint  NOT NULL GENERATED ALWAYS AS IDENTITY,
  co_seq_fat_profissional_cbo       bigint  NOT NULL,
  co_seq_fat_unidade_equipe         bigint  NOT NULL,
  co_seq_dim_competencia            bigint  NOT NULL,
  und_eqp_prf_entrada               varchar,
  und_eqp_prf_saida                 varchar,
  PRIMARY KEY (co_seq_tb_fat_equipe_profissional)
);

COMMENT ON TABLE tb_fat_unidade_equipe_profissional IS 'relacionamento entre profissional e equipe';

COMMENT ON COLUMN tb_fat_unidade_equipe_profissional.co_seq_tb_fat_equipe_profissional IS 'PK';

COMMENT ON COLUMN tb_fat_unidade_equipe_profissional.co_seq_fat_profissional_cbo IS 'FK referencia fat_proficional_cbo';

COMMENT ON COLUMN tb_fat_unidade_equipe_profissional.co_seq_fat_unidade_equipe IS 'FK referencia tb_fat_unidade_equipe';

COMMENT ON COLUMN tb_fat_unidade_equipe_profissional.co_seq_dim_competencia IS 'FK referencia a competencia';

CREATE TABLE tb_fat_unidade_programas
(
  co_seq_tb_fat_unidade_programas bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  co_seq_dim_unidade              bigint NOT NULL,
  co_seq_dim_programas            bigint NOT NULL,
  co_seq_dim_competencia          bigint NOT NULL,
  PRIMARY KEY (co_seq_tb_fat_unidade_programas)
);

COMMENT ON COLUMN tb_fat_unidade_programas.co_seq_dim_unidade IS 'PK tb_dim_unidade';

COMMENT ON COLUMN tb_fat_unidade_programas.co_seq_dim_programas IS 'PK tb_dim_programas';

COMMENT ON COLUMN tb_fat_unidade_programas.co_seq_dim_competencia IS 'PK tb_dim_competencia';

CREATE TABLE tb_fat_unidade_situacao
(
  co_seq_tb_fat_unidade_situacao bigint  NOT NULL GENERATED ALWAYS AS IDENTITY,
  co_seq_dim_unidade             bigint  NOT NULL,
  co_seq_dim_competencia         bigint  NOT NULL,
  ds_motivo_desab                varchar,
  tipo_unidade                   varchar NOT NULL,
  PRIMARY KEY (co_seq_tb_fat_unidade_situacao)
);

COMMENT ON COLUMN tb_fat_unidade_situacao.co_seq_tb_fat_unidade_situacao IS 'pk co_seq_tb_fat_unidade_situacao';

COMMENT ON COLUMN tb_fat_unidade_situacao.co_seq_dim_unidade IS 'PK tb_dim_unidade';

COMMENT ON COLUMN tb_fat_unidade_situacao.co_seq_dim_competencia IS 'PK tb_dim_competencia';

COMMENT ON COLUMN tb_fat_unidade_situacao.tipo_unidade IS 'tipo da unidade';

ALTER TABLE tb_fat_profissional_cbo
  ADD CONSTRAINT FK_tb_dim_profissional_TO_tb_fat_profissional_cbo
    FOREIGN KEY (co_seq_dim_profissional)
    REFERENCES tb_dim_profissional (co_seq_dim_profissional);

ALTER TABLE tb_fat_profissional_cbo
  ADD CONSTRAINT FK_tb_dim_cbo_TO_tb_fat_profissional_cbo
    FOREIGN KEY (co_seq_dim_cbo)
    REFERENCES tb_dim_cbo (co_seq_dim_cbo);

ALTER TABLE tb_fat_unidade_equipe_profissional
  ADD CONSTRAINT FK_tb_fat_profissional_cbo_TO_tb_fat_unidade_equipe_profissional
    FOREIGN KEY (co_seq_fat_profissional_cbo)
    REFERENCES tb_fat_profissional_cbo (co_seq_fat_profissional_cbo);

ALTER TABLE tb_dim_unidade
  ADD CONSTRAINT FK_tb_dim_distrito_TO_tb_dim_unidade
    FOREIGN KEY (co_seq_dim_distrito)
    REFERENCES tb_dim_distrito (co_seq_dim_distrito);

ALTER TABLE tb_fat_profissional_cbo
  ADD CONSTRAINT FK_tb_dim_vinculo_TO_tb_fat_profissional_cbo
    FOREIGN KEY (co_seq_fat_dim_vinculo)
    REFERENCES tb_dim_vinculo (co_seq_fat_dim_vinculo);

ALTER TABLE tb_fat_unidade_equipe_profissional
  ADD CONSTRAINT FK_tb_dim_competencia_TO_tb_fat_unidade_equipe_profissional
    FOREIGN KEY (co_seq_dim_competencia)
    REFERENCES tb_dim_competencia (co_seq_dim_competencia);

ALTER TABLE tb_fat_profissional_cbo
  ADD CONSTRAINT FK_tb_dim_competencia_TO_tb_fat_profissional_cbo
    FOREIGN KEY (co_seq_dim_competencia)
    REFERENCES tb_dim_competencia (co_seq_dim_competencia);

ALTER TABLE tb_dim_cns
  ADD CONSTRAINT FK_tb_dim_profissional_TO_tb_dim_cns
    FOREIGN KEY (co_seq_dim_profissional)
    REFERENCES tb_dim_profissional (co_seq_dim_profissional);

ALTER TABLE tb_fat_equipe_tipoequipe
  ADD CONSTRAINT FK_tb_dim_equipe_TO_tb_fat_equipe_tipoequipe
    FOREIGN KEY (co_seq_dim_equipe)
    REFERENCES tb_dim_equipe (co_seq_dim_equipe);

ALTER TABLE tb_fat_equipe_tipoequipe
  ADD CONSTRAINT FK_tb_dim_tipoequipe_TO_tb_fat_equipe_tipoequipe
    FOREIGN KEY (co_seq_dim_tipo_equipe)
    REFERENCES tb_dim_tipoequipe (co_seq_dim_tipo_equipe);

ALTER TABLE tb_fat_equipe_tipoequipe
  ADD CONSTRAINT FK_tb_dim_competencia_TO_tb_fat_equipe_tipoequipe
    FOREIGN KEY (co_seq_dim_competencia)
    REFERENCES tb_dim_competencia (co_seq_dim_competencia);

ALTER TABLE tb_fat_unidade_equipe
  ADD CONSTRAINT FK_tb_dim_unidade_TO_tb_fat_unidade_equipe
    FOREIGN KEY (co_seq_dim_unidade)
    REFERENCES tb_dim_unidade (co_seq_dim_unidade);

ALTER TABLE tb_fat_unidade_equipe
  ADD CONSTRAINT FK_tb_dim_equipe_TO_tb_fat_unidade_equipe
    FOREIGN KEY (co_seq_dim_equipe)
    REFERENCES tb_dim_equipe (co_seq_dim_equipe);

ALTER TABLE tb_fat_unidade_equipe_profissional
  ADD CONSTRAINT FK_tb_fat_unidade_equipe_TO_tb_fat_unidade_equipe_profissional
    FOREIGN KEY (co_seq_fat_unidade_equipe)
    REFERENCES tb_fat_unidade_equipe (co_seq_fat_unidade_equipe);

ALTER TABLE tb_fat_unidade_equipe
  ADD CONSTRAINT FK_tb_dim_competencia_TO_tb_fat_unidade_equipe
    FOREIGN KEY (co_seq_dim_competencia)
    REFERENCES tb_dim_competencia (co_seq_dim_competencia);

ALTER TABLE tb_fat_equipe_equipe
  ADD CONSTRAINT FK_tb_dim_equipe_TO_tb_fat_equipe_equipe
    FOREIGN KEY (co_seq_dim_equipe)
    REFERENCES tb_dim_equipe (co_seq_dim_equipe);

ALTER TABLE tb_fat_equipe_equipe
  ADD CONSTRAINT FK_tb_dim_equipe_TO_tb_fat_equipe_equipe1
    FOREIGN KEY (co_seq_dim_equipe_esb)
    REFERENCES tb_dim_equipe (co_seq_dim_equipe);

ALTER TABLE tb_fat_equipe_equipe
  ADD CONSTRAINT FK_tb_dim_competencia_TO_tb_fat_equipe_equipe
    FOREIGN KEY (co_seq_dim_competencia)
    REFERENCES tb_dim_competencia (co_seq_dim_competencia);

ALTER TABLE tb_fat_profissional_cbo
  ADD CONSTRAINT FK_tb_dim_cargahoraria_TO_tb_fat_profissional_cbo
    FOREIGN KEY (co_seq_dim_cargahoraria)
    REFERENCES tb_dim_cargahoraria (co_seq_dim_cargahoraria);

ALTER TABLE tb_fat_unidade_programas
  ADD CONSTRAINT FK_tb_dim_unidade_TO_tb_fat_unidade_programas
    FOREIGN KEY (co_seq_dim_unidade)
    REFERENCES tb_dim_unidade (co_seq_dim_unidade);

ALTER TABLE tb_fat_unidade_programas
  ADD CONSTRAINT FK_tb_dim_programas_TO_tb_fat_unidade_programas
    FOREIGN KEY (co_seq_dim_programas)
    REFERENCES tb_dim_programas (co_seq_dim_programas);

ALTER TABLE tb_fat_unidade_programas
  ADD CONSTRAINT FK_tb_dim_competencia_TO_tb_fat_unidade_programas
    FOREIGN KEY (co_seq_dim_competencia)
    REFERENCES tb_dim_competencia (co_seq_dim_competencia);

ALTER TABLE tb_fat_portaria_equipe
  ADD CONSTRAINT FK_tb_dim_portarias_TO_tb_fat_portaria_equipe
    FOREIGN KEY (co_seq_dim_portarias)
    REFERENCES tb_dim_portarias (co_seq_dim_portarias);

ALTER TABLE tb_fat_portaria_equipe
  ADD CONSTRAINT FK_tb_dim_equipe_TO_tb_fat_portaria_equipe
    FOREIGN KEY (co_seq_dim_equipe)
    REFERENCES tb_dim_equipe (co_seq_dim_equipe);

ALTER TABLE tb_fat_portaria_equipe
  ADD CONSTRAINT FK_tb_dim_competencia_TO_tb_fat_portaria_equipe
    FOREIGN KEY (co_seq_dim_competencia)
    REFERENCES tb_dim_competencia (co_seq_dim_competencia);

ALTER TABLE tb_fat_unidade_situacao
  ADD CONSTRAINT FK_tb_dim_unidade_TO_tb_fat_unidade_situacao
    FOREIGN KEY (co_seq_dim_unidade)
    REFERENCES tb_dim_unidade (co_seq_dim_unidade);

ALTER TABLE tb_fat_unidade_situacao
  ADD CONSTRAINT FK_tb_dim_competencia_TO_tb_fat_unidade_situacao
    FOREIGN KEY (co_seq_dim_competencia)
    REFERENCES tb_dim_competencia (co_seq_dim_competencia);
