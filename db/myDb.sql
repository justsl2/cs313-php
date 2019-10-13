DROP SCHEMA public CASCADE;
CREATE SCHEMA public;

/******************************************************************************
* Author:
*  Justin Hurst
* Description:
*  Ponder04 Assignment. This file establishes some basic data for my incident 
*  management system database.
******************************************************************************/
CREATE TABLE public.sites (
   site_id SERIAL PRIMARY KEY,		
   site_label VARCHAR(100) NOT NULL,
   site_active BOOLEAN NOT NULL 
);

CREATE TABLE public.departments (
   department_id SERIAL PRIMARY KEY,		
   department_label VARCHAR(100) NOT NULL,
   department_active BOOLEAN NOT NULL 
);

CREATE TABLE public.consequence_types (
   consequence_type_id SERIAL PRIMARY KEY,		
   consequence_type_label VARCHAR(20) NOT NULL,
   consequence_type_active BOOLEAN NOT NULL 
);

CREATE TABLE public.event_types (
   event_type_id SERIAL PRIMARY KEY,		
   event_type_label VARCHAR(20) NOT NULL,
   event_type_active BOOLEAN NOT NULL 
);

CREATE TABLE public.severities (
   severity_id SERIAL PRIMARY KEY,		
   severity_label VARCHAR(20) NOT NULL,
   severity_active BOOLEAN NOT NULL 
);

CREATE TABLE public.statuses (
   status_id SERIAL PRIMARY KEY,		
   status_label VARCHAR(20) NOT NULL,
   status_active BOOLEAN NOT NULL 
);

CREATE TABLE public.temperature_uoms (
   temperature_uom_id SERIAL PRIMARY KEY,		
   temperature_uom_label VARCHAR(20) NOT NULL,
   temperature_uom_active BOOLEAN NOT NULL 
);

CREATE TABLE public.weathers (
   weather_id SERIAL PRIMARY KEY,		
   weather_label VARCHAR(20) NOT NULL,
   weather_active BOOLEAN NOT NULL 
);

CREATE TABLE public.lightings (
   lighting_id SERIAL PRIMARY KEY,		
   lighting_label VARCHAR(20) NOT NULL,
   lighting_active BOOLEAN NOT NULL 
);

CREATE TABLE public.operation_types (
   operation_type_id SERIAL PRIMARY KEY,		
   operation_type_label VARCHAR(50) NOT NULL,
   operation_type_active BOOLEAN NOT NULL 
);

CREATE TABLE public.activity_types (
   activity_type_id SERIAL PRIMARY KEY,		
   activity_type_label VARCHAR(50) NOT NULL,
   activity_type_active BOOLEAN NOT NULL 
);

CREATE TABLE public.medical_classifications (
   medical_classification_id SERIAL PRIMARY KEY,		
   medical_classification_label VARCHAR(50) NOT NULL,
   medical_classification_active BOOLEAN NOT NULL 
);

CREATE TABLE public.company_names (
   company_name_id SERIAL PRIMARY KEY,		
   company_name_label VARCHAR(50) NOT NULL,
   company_name_active BOOLEAN NOT NULL 
);

CREATE TABLE public.personnel_types (
   personnel_type_id SERIAL PRIMARY KEY,		
   personnel_type_label VARCHAR(50) NOT NULL,
   personnel_type_active BOOLEAN NOT NULL 
);

CREATE TABLE public.injury_natures (
   injury_nature_id SERIAL PRIMARY KEY,		
   injury_nature_label VARCHAR(50) NOT NULL,
   injury_nature_active BOOLEAN NOT NULL 
);

CREATE TABLE public.injury_exposures (
   injury_exposure_id SERIAL PRIMARY KEY,		
   injury_exposure_label VARCHAR(50) NOT NULL,
   injury_exposure_active BOOLEAN NOT NULL 
);

CREATE TABLE public.injury_primary_body_parts (
   injury_primary_body_part_id SERIAL PRIMARY KEY,		
   injury_primary_body_part_label VARCHAR(50) NOT NULL,
   injury_primary_body_part_active BOOLEAN NOT NULL 
);

CREATE TABLE public.users (
   user_id SERIAL PRIMARY KEY,		
   user_name VARCHAR(100) NOT NULL UNIQUE,
   user_password VARCHAR(100) NOT NULL,
   user_name_first VARCHAR(100) NOT NULL,
   user_name_last VARCHAR(100) NOT NULL,
   user_name_middle VARCHAR(100),
   user_active BOOLEAN NOT NULL  
);

CREATE TABLE public.events (
   event_id SERIAL PRIMARY KEY,		
   date_occurred DATE NOT NULL,
   date_reported DATE,
   date_entered DATE NOT NULL,
   description_short VARCHAR(500) NOT NULL,
   description_long VARCHAR(4000) NOT NULL,
   site_id INT NOT NULL REFERENCES public.sites(site_id),
   department_id INT NOT NULL REFERENCES public.departments(department_id),
   event_type_id INT NOT NULL REFERENCES public.event_types(event_type_id),
   severity_actual_id INT REFERENCES public.severities(severity_id),
   severity_probable_id INT REFERENCES public.severities(severity_id),
   event_status_id INT NOT NULL REFERENCES public.statuses(status_id),
   temperature INT,
   temperature_uom_id INT REFERENCES public.temperature_uoms(temperature_uom_id),
   weather_id INT REFERENCES public.weathers(weather_id),
   lighting_id INT REFERENCES public.lightings(lighting_id),
   operation_type_id INT REFERENCES public.operation_types(operation_type_id),
   activity_type_id INT REFERENCES public.activity_types(activity_type_id),
   reporting_boudnary BOOLEAN,
   entered_by_id INT NOT NULL REFERENCES public.users(user_id),
   reported_by_id INT REFERENCES public.users(user_id),
   qa_qc_by_id INT REFERENCES public.users(user_id),
   equipment VARCHAR(100),   
   consequence_type_id INT REFERENCES public.consequence_types(consequence_type_id)
);

CREATE TABLE public.injuries (
   injury_id SERIAL PRIMARY KEY,
   event_id INT NOT NULL REFERENCES public.events(event_id),
   injured_ill_personnel_type_id INT REFERENCES public.personnel_types(personnel_type_id),
   work_related BOOLEAN,
   medical_classification_id INT REFERENCES public.medical_classifications(medical_classification_id),
   injury_description VARCHAR(2000),
   injury_nature_id INT REFERENCES public.injury_natures(injury_nature_id),
   injury_exposure_id INT REFERENCES public.injury_exposures(injury_exposure_id),
   injury_primary_body_part_id INT REFERENCES public.injury_primary_body_parts(injury_primary_body_part_id),
   injury_lost_days INT,
   injury_lost_days_start_date DATE,
   company_name_id INT REFERENCES public.company_names(company_name_id),
   injury_status_id INT NOT NULL REFERENCES public.statuses(status_id)
);
