-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2016 at 07:56 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `msaddr_type`
--

CREATE TABLE `msaddr_type` (
  `Id` varchar(10) NOT NULL DEFAULT '' COMMENT 'inf ttg tipe addres:office,billing,warehouse dll',
  `Name` varchar(50) NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `CreatedDate` datetime NOT NULL DEFAULT '2010-01-01 00:00:00',
  `ModifiedBy` varchar(50) NOT NULL DEFAULT '',
  `ModifiedDate` datetime NOT NULL DEFAULT '2010-01-01 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msaddr_type`
--

INSERT INTO `msaddr_type` (`Id`, `Name`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
('0001', 'Head Office', 'admin', '2010-01-01 00:00:00', '', '2010-01-01 00:00:00'),
('0002', 'Branch Office', 'admin', '2010-01-01 00:00:00', '', '2010-01-01 00:00:00'),
('0003', 'Warehouse', 'admin', '2010-01-01 00:00:00', '', '2010-01-01 00:00:00'),
('0005', 'Factory', 'admin', '2010-01-01 00:00:00', '', '2010-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `msbusiness_type`
--

CREATE TABLE `msbusiness_type` (
  `Id` varchar(5) NOT NULL DEFAULT '',
  `Description` varchar(100) NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `CreatedDate` datetime NOT NULL DEFAULT '2016-01-01 00:00:00',
  `ModifiedBy` varchar(50) NOT NULL DEFAULT '',
  `ModifiedDate` datetime NOT NULL DEFAULT '2016-01-01 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msbusiness_type`
--

INSERT INTO `msbusiness_type` (`Id`, `Description`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
('0001', 'Manufacturer', 'admin', '2016-01-01 00:00:00', '', '2016-01-01 00:00:00'),
('0002', 'Trading', 'admin', '2016-01-01 00:00:00', '', '2016-01-01 00:00:00'),
('0003', 'Distributor', 'admin', '2016-01-01 00:00:00', '', '2016-01-01 00:00:00'),
('0004', 'Agent', 'admin', '2016-01-01 00:00:00', '', '2016-01-01 00:00:00'),
('0005', 'Shipper', 'admin', '2016-01-01 00:00:00', '', '2016-01-01 00:00:00'),
('0006', 'Consignee', 'admin', '2016-01-01 00:00:00', '', '2016-01-01 00:00:00'),
('0007', 'Airlines', 'admin', '2016-01-01 00:00:00', '', '2016-01-01 00:00:00'),
('0008', 'Shippinglines', 'admin', '2016-01-01 00:00:00', '', '2016-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mscity`
--

CREATE TABLE `mscity` (
  `Id` char(3) NOT NULL DEFAULT '',
  `Name` varchar(250) NOT NULL DEFAULT '',
  `IdCou` char(2) NOT NULL DEFAULT '',
  `state` varchar(250) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mscity`
--

INSERT INTO `mscity` (`Id`, `Name`, `IdCou`, `state`) VALUES
('AAE', 'ANNABA', 'DZ', ''),
('AAL', 'AALBORG', 'DK', ''),
('AAR', 'AARHUS', 'DK', ''),
('ABD', 'ABADAN', 'IR', ''),
('ABN', 'AMBON', 'ID', ''),
('ABR', 'ABERDEEN', 'US', ''),
('ADD', 'ADDIS ABABA', 'ET', ''),
('ADE', 'ADEN', 'YE', ''),
('ADL', 'ADELAIDE', 'AU', ''),
('AGP', 'MALAGA', 'ES', ''),
('AKL', 'AUCKLAND', 'NZ', ''),
('ALC', 'ALICANTE', 'ES', ''),
('ALX', 'ALEXANDRIA', 'EG', ''),
('AMD', 'AHMEDABAD', 'IN', ''),
('AMI', 'MATARAM', 'ID', ''),
('AMM', 'AMMAN', 'JO', ''),
('AMS', 'AMSTERDAM', 'NL', ''),
('ANC', 'ANCHORAGE', 'US', 'AK'),
('ANK', 'ANKARA', 'TR', ''),
('ANR', 'ANTWERP,BELGIUM', 'BE', ''),
('ANT', 'ANTWERPEN', 'FR', ''),
('ANU', 'ANTIGUA', 'AG', ''),
('AOI', 'ANCONA', 'IT', ''),
('APF', 'NAPLES', 'IT', ''),
('APW', 'APIA', 'WS', ''),
('ASH', 'ASDHOD', 'IS', 'ISRAEL'),
('ASU', 'ASUNCION', 'PY', ''),
('ATH', 'ATHENS', 'GR', ''),
('ATL', 'ATLANTA', 'US', 'GA'),
('AUA', 'ARUBA', 'AW', ''),
('AUH', 'ABU DHABI', 'AE', ''),
('BAH', 'BAHRAIN', 'BH', ''),
('BAU', 'BAU BAU', 'ID', 'INDONESIA'),
('BCH', 'BUCHUN', 'KR', ''),
('BCN', 'BARCELONA,SPAIN', 'ES', ''),
('BDA', 'BANDA ACEH', 'ID', ''),
('BDJ', 'BANJARMASIN', 'ID', ''),
('BDL', 'BANDAR LAMPUNG', 'ID', ''),
('BDO', 'BANDUNG', 'ID', ''),
('BEG', 'BELGRADE', 'YU', ''),
('BER', 'BERLIN', 'DE', ''),
('BEY', 'BEIRUT', 'LB', ''),
('BFS', 'BELFAST', 'GB', ''),
('BGR', 'BOGOR', 'ID', ''),
('BGW', 'BAGHDAD', 'IQ', ''),
('BHX', 'BIRMINGHAM', 'GB', ''),
('BIK', 'BIAK', 'ID', ''),
('BIM', 'BIMA', 'ID', ''),
('BIO', 'BILBAO', 'ES', ''),
('BIT', 'BITUNG', 'ID', 'MANADO'),
('BJM', 'BUJUMBURA', 'BI', ''),
('BJS', 'BEIJING', 'CN', ''),
('BKK', 'BANGKOK', 'TH', ''),
('BKS', 'BENGKULU', 'ID', ''),
('BLG', 'BELAGA', 'MY', ''),
('BLI', 'BALI', 'ID', ''),
('BLL', 'BILLUND', 'DK', ''),
('BLQ', 'BOLOGNA', 'IT', ''),
('BLR', 'BANGALORE', 'IN', ''),
('BLW', 'BELAWAN', 'ID', ''),
('BNE', 'BRISBANE', 'AU', ''),
('BOD', 'BORDEAUX', 'FR', ''),
('BOG', 'BOGOTA', 'CO', ''),
('BOM', 'MUMBAI', 'IN', ''),
('BOS', 'BOSTON', 'US', ''),
('BPN', 'BALIKPAPAN', 'ID', ''),
('BRA', 'BERAU', 'ID', 'KALIMANTAN'),
('BRE', 'BREMEN', 'DE', ''),
('BRS', 'BRISTOL', 'GB', ''),
('BRU', 'BRUSSELS', 'BE', ''),
('BSL', 'BASLE', 'CH', ''),
('BSR', 'BASRA', 'IQ', ''),
('BTH', 'BATAM', 'ID', 'BATAM'),
('BTJ', 'BANDA ACEH', 'ID', ''),
('BUD', 'BUDAPEST', 'HU', ''),
('BUE', 'BUENOS AIRES', 'AR', ''),
('BUH', 'BUCHAREST AIRPORT', 'RO', ''),
('BUO', 'BULAWAYO', 'ZW', ''),
('BUS', 'BUSAN, KOREA', 'KR', ''),
('BWI', 'BALTIMORE', 'US', 'MD'),
('BWN', 'BANDAR SRI BEGAWAN', 'BN', ''),
('CAG', 'CAGLIARI', 'IT', ''),
('CAI', 'CAIRO', 'EG', ''),
('CAL', 'CALIFORNIA', 'US', ''),
('CAN', 'GUANGZHOU', 'CN', ''),
('CAS', 'CASABLANCA', 'MA', ''),
('CAY', 'CAYENNE', 'GF', ''),
('CBR', 'CANBERRA', 'AU', ''),
('CCP', 'CONCEPCION', 'CL', ''),
('CCS', 'CARACAS', 'VE', ''),
('CCU', 'CALCUTTA', 'IN', 'INDIA'),
('CDG', 'CHARLES DE GAULLE, PARIS', 'FR', ''),
('CDU', 'CHENGDU', 'CN', ''),
('CDX', 'CEDEX', 'FR', ''),
('CEB', 'CEBU', 'PH', ''),
('CGK', 'SOEKARNO HATTA', 'ID', ''),
('CGN', 'COLOGNE', 'DE', ''),
('CGQ', 'CHANGCHUN LONGJIA', 'CN', ''),
('CHC', 'CHRISTCHURCH', 'NZ', ''),
('CHE', 'CHENNAI', 'IN', 'INDIA'),
('CHI', 'CHICAGO', 'US', ''),
('CHN', 'XINGANG', 'CH', 'CHINA'),
('CHS', 'CHARLESTON', 'US', ''),
('CIN', 'CINCIINNATI', 'US', 'OHIO'),
('CIR', 'CIREBON', 'ID', 'JAKARTA'),
('CJS', 'CIUDAD JUAREZ', 'MX', ''),
('CKY', 'CONAKRY', 'LK', ''),
('CLO', 'CALI', 'CO', ''),
('CLT', 'CHARLOTTE', 'US', ''),
('CMB', 'COLOMBO', 'LK', ''),
('CMH', 'COLUMBUS', 'US', ''),
('CMN', 'CASABLANCA', 'MA', ''),
('CND', 'CANADA', 'US', ''),
('CNJ', 'CIANJUR', 'ID', 'JAWA BARAT'),
('CNS', 'CAIRNS', 'AU', ''),
('CNX', 'CHIANG MAI', 'TH', ''),
('COC', 'COCHIN', 'IN', 'INDIA'),
('COO', 'COTONOU', 'BJ', ''),
('CPH', 'COPENHAGEN', 'DK', ''),
('CPT', 'CAPE TOWN', 'ZA', ''),
('CSX', 'CHANGSHA, HUNAN', 'CN', ''),
('CTA', 'CATANIA', 'IT', ''),
('CUL', 'CULIACAN', 'MX', ''),
('CUN', 'CANCUN', 'MX', ''),
('CUR', 'CURACAO', 'AN', ''),
('CWB', 'CURITIBA', 'BR', ''),
('CWL', 'CARDIFF', 'GB', ''),
('CZL', 'CONSTANTINE', 'DZ', ''),
('CZM', 'COZUMEL', 'MX', ''),
('DAC', 'DHAKA', 'BD', ''),
('DAM', 'DAMASCUS', 'SY', ''),
('DAR', 'DAR ES SALAAM', 'TZ', ''),
('DBV', 'DUBROVNIK', 'HR', ''),
('DEL', 'DELHI', 'IN', ''),
('DEN', 'DENVER', 'US', ''),
('DET', 'DETROIT', 'US', ''),
('DFW', 'DALLAS', 'US', ''),
('DGO', 'DURANGO', 'MX', ''),
('DJB', 'JAMBI', 'ID', ''),
('DJJ', 'JAYA PURA', 'ID', ''),
('DKR', 'DAKAR', 'SN', ''),
('DLA', 'DOUALA', 'CM', ''),
('DLC', 'DALIAN', 'CN', ''),
('DME', 'DOMODEDOVO', 'RU', ''),
('DMK', 'DON MUANG', 'TH', ''),
('DMM', 'DAMMAM', 'SA', ''),
('DMT', 'DAMIETTA', 'EG', ''),
('DOG', 'DONG GUANG FU-CHENG AREA.,', 'CN', 'GUANGDONG'),
('DOH', 'DOHA', 'QA', ''),
('DOM', 'DOMINICA', 'DM', ''),
('DOR', 'DORVAL, CANADA', 'CA', ''),
('DPS', 'DENPASAR', 'ID', ''),
('DRN', 'DORNBIRN', 'AT', ''),
('DRS', 'DRESDEN', 'DE', ''),
('DRW', 'DARWIN', 'AU', 'NT'),
('DSK', 'DISTIKO', 'ID', ''),
('DTM', 'DORTMUND', 'DE', ''),
('DTT', 'DETROIT', 'US', ''),
('DUB', 'DUBLIN, IRELAND', 'IE', ''),
('DUR', 'DURBAN', 'ZA', ''),
('DUS', 'DUSSELDORF', 'DE', ''),
('DVO', 'DAVAO', 'PH', ''),
('DXB', 'DUBAI', 'AE', ''),
('EBB', 'ENTEBBE', 'UG', ''),
('EDI', 'EDINBURGH', 'GB', ''),
('EIN', 'EINDHOVEN', 'NL', ''),
('ELS', 'EAST LONDON', 'ZA', ''),
('ENS', 'ENSCHEDE', 'DE', ''),
('ERW', 'NEW ARK', 'US', ''),
('EZE', 'EZEIZA', 'AR', ''),
('FAD', 'FARO', 'PT', ''),
('FCO', 'FIUMICINO, ROMA', 'IT', ''),
('FDF', 'FT DE FRANCE', 'MQ', ''),
('FDH', 'FRIEDRICHSHAF', 'DE', ''),
('FLT', 'FELIXSTOWE', 'UK', ''),
('FMO', 'MUENSTER', 'DE', ''),
('FNA', 'FREETOWN', 'SL', ''),
('FNC', 'FUNCHAL', 'PT', ''),
('FNJ', 'PYONGYANG', 'KP', ''),
('FOC', 'FUZHOU', 'CN', ''),
('FPO', 'FREEPORT', 'BS', ''),
('FRA', 'FRANKFURT', 'DE', ''),
('FRE', 'FREMANTLE', 'AU', 'AUSTRALIA'),
('FUK', 'FUKUOKA', 'JP', ''),
('GAN', 'GAN XIU SHUO', 'CH', 'CHINA'),
('GCI', 'GUERNSEY', 'GB', ''),
('GDG', 'GUANGDONG', 'CN', 'CHINA'),
('GDL', 'GUADALAJARA', 'MX', ''),
('GDY', 'GDYNIA', 'PL', ''),
('GEO', 'GEORGETOWN', 'GY', ''),
('GIB', 'GIBRALTAR', 'GI', ''),
('GLA', 'GLASGOW', 'GB', ''),
('GNG', 'GUANGZHOU', 'CN', 'CHINA'),
('GOA', 'GENOA', 'IT', ''),
('GOT', 'GOTHENBURG', 'SE', ''),
('GRJ', 'GEORGE', 'ZA', ''),
('GRU', 'GUARULHOS APT', 'US', ''),
('GRZ', 'GRAZ', 'AT', ''),
('GSO', 'GREENSBORO, NC', 'NC', 'USA'),
('GTO', 'GORONTALO', 'ID', 'GORONTALO'),
('GUA', 'GUATEMALA CITY', 'GT', ''),
('GUM', 'GUAM', 'GU', ''),
('GVA', 'GENEVA', 'CH', ''),
('GYD', 'BAKU', 'AZ', 'AZERBAIJAN'),
('GYE', 'GUAYAQUIL', 'EC', ''),
('HAJ', 'HANOVER', 'DE', ''),
('HAM', 'HAMBURG', 'DE', ''),
('HAN', 'HANOI', 'VN', ''),
('HAV', 'HAVANA', 'CU', ''),
('HCM', 'HO CHI MINH', 'VN', ''),
('HDY', 'HATYAI', 'TH', ''),
('HEL', 'HELSINSKY', 'FI', ''),
('HFA', 'HAIFA', 'IL', 'ISRAEL'),
('HGH', 'HANG ZHOU', 'CN', ''),
('HIJ', 'HIROSHIMA', 'JP', ''),
('HKG', 'HONGKONG', 'HK', ''),
('HKT', 'PHUKET', 'TH', ''),
('HLP', 'HALIM PERDANA KUSUMAH, JAKARTA', 'ID', ''),
('HMO', 'HERMOSILLO', 'MX', ''),
('HND', 'HANEDA', 'JP', ''),
('HNI', 'HANOI', 'VN', 'VIETNAM'),
('HNL', 'HONOLULU', 'US', ''),
('HOC', 'HOCHIMINH CITY', 'VN', ''),
('HOS', 'HOUSTON, TEXAS', 'US', ''),
('HOY', 'HAT YAI', 'TH', ''),
('HPH', 'HAIPHONG', 'VN', 'VIETNAM'),
('HPU', 'HUANGPU,CHINA', 'CN', ''),
('HUA', 'HUANGPU', 'CN', ''),
('IAD', 'WASHINGTON', 'US', ''),
('IAH', 'HOUSTON', 'US', ''),
('ICN', 'INCHEON', 'KR', 'KOREA'),
('IEV', 'KIEV', 'UA', ''),
('IMB', 'IMMABARI', 'JP', ''),
('IMZ', 'KETAPANG', 'ID', ''),
('INC', 'INCHEON', 'KR', ''),
('INN', 'INNSBRUCK', 'AT', ''),
('IOM', 'ISLE OF MAN', 'GB', ''),
('IST', 'ISTANBUL', 'TR', ''),
('IZM', 'IZMIR', 'TR', ''),
('JAX', 'JACKSONVILLE', 'US', 'FLORIDA'),
('JED', 'JEDDAH', 'SA', ''),
('JER', 'JERSEY', 'GB', ''),
('JFK', 'JOHN F KENNEDY, NEW YORK', 'US', 'NEW YORK'),
('JHB', 'JOHOR BAHRU', 'MY', ''),
('JIB', 'DJIBOUTI', 'DJ', ''),
('JKG', 'JONKOPING', 'SE', ''),
('JKT', 'JAKARTA', 'ID', ''),
('JNB', 'JOHANNESBURG', 'ZA', ''),
('JOG', 'JOGJAKARTA', 'ID', 'JAWA TENGAH'),
('JPN', 'KOBE', 'JP', 'JAPAN'),
('JPO', 'MOJI', 'JP', 'JEPANG'),
('JRO', 'KILIMANJARO', 'TZ', ''),
('KAI', 'KAILUA (MAUI)', 'US', ''),
('KAN', 'KWANGYANG', 'KR', ''),
('KAZ', 'KAZ/AMBON', 'ID', ''),
('KBL', 'KABUL', 'AF', ''),
('KBP', 'KIEV', 'UA', ''),
('KCH', 'KUCHING', 'MY', ''),
('KDI', 'KENDARI', 'ID', 'SULAWESI TENGGARA'),
('KEE', 'KEELUNG, TAIWAN', 'TW', ''),
('KEL', 'KEELUNG', 'TW', ''),
('KHH', 'KAOHSIUNG', 'TW', ''),
('KHI', 'KARACHI', 'PK', ''),
('KIJ', 'NIIGATA', 'JP', ''),
('KIM', 'KIMBERLEY', 'ZA', ''),
('KIN', 'KINGSTON', 'JM', ''),
('KIX', 'OSAKA', 'JP', ''),
('KLU', 'KLAGENFURT', 'AT', ''),
('KMG', 'KUNMING', 'CN', ''),
('KOB', 'KOBE', 'JP', ''),
('KOE', 'KUPANG', 'ID', ''),
('KRK', 'KRAKOW', 'PL', ''),
('KRS', 'KRISTIANSAND', 'NO', ''),
('KRT', 'KHARTOUM', 'SD', ''),
('KTM', 'KATHAMANDU', 'NP', ''),
('KUA', 'KUANTAN', 'MY', ''),
('KUL', 'KUALA LUMPUR', 'MY', ''),
('KUM', 'KUALA AMPANG', 'MY', ''),
('KWI', 'KUWAIT', 'KW', ''),
('LAP', 'LA PAZ', 'MX', ''),
('LAS', 'LAS VEGAS', 'US', ''),
('LAX', 'LOS ANGELES', 'US', 'CA'),
('LBA', 'LEEDS', 'GB', ''),
('LBJ', 'LABUAN BAJO', 'ID', ''),
('LCA', 'LARNACA', 'CY', ''),
('LCH', 'LAEM CHABANG', 'TH', ''),
('LFW', 'LOME', 'TG', ''),
('LGB', 'LONGBEACH', 'US', ''),
('LHE', 'LAHORE', 'PK', ''),
('LHR', 'LONDON HEATHROW', 'GB', ''),
('LHS', 'LIAN HUA SHAN', 'CN', ''),
('LHV', 'LE HAVRE', 'FR', ''),
('LHW', 'LANZHOU,CHINA', 'CN', ''),
('LIA', 'LIMA USA', 'US', ''),
('LIL', 'LILLE', 'FR', ''),
('LIM', 'LIMA', 'PE', ''),
('LIS', 'LISBON', 'PT', ''),
('LJU', 'LJUBLANA', 'SI', ''),
('LMS', 'LIMMASOL', 'CY', ''),
('LNZ', 'LINZ', 'AT', ''),
('LON', 'LONDON', 'UK', ''),
('LOP', 'LOMBOK PRAYA', 'ID', 'JAKARTA'),
('LOS', 'LAGOS', 'NG', ''),
('LPA', 'LAS PALMAS', 'ES', ''),
('LPB', 'LA PAZ', 'BO', ''),
('LPL', 'LIVERPOOL', 'GB', ''),
('LRD', 'LAREDO', 'US', 'LAREDO'),
('LSZ', 'LA SPEZIA, ITALY', 'IT', ''),
('LUW', 'LUWUK', 'ID', 'SULAWESI TENGAH'),
('LUX', 'LUXEMBURG', 'LU', ''),
('LWO', 'LVIV', 'UA', ''),
('LYS', 'LYON ST. EXUPERY', 'FR', ''),
('MAA', 'CHENNAI', 'IN', ''),
('MAD', 'MADRID', 'ES', ''),
('MAN', 'MANCHESTER', 'UK', ''),
('MAO', 'MANAUS', 'BR', ''),
('MAR', 'MARACAIBO', 'VE', ''),
('MAS', 'MADRAS', 'IN', 'INDIA'),
('MAT', 'MATADI', 'CG', ''),
('MBA', 'MOMBASA', 'KE', ''),
('MCT', 'MUSCAT', 'OM', 'OMAN'),
('MDC', 'MANADO', 'ID', ''),
('MDE', 'MEDELLIN', 'CO', ''),
('MEL', 'MELBOURNE', 'AU', ''),
('MEM', 'MEMPHIS.TN.U.S.A', 'US', ''),
('MES', 'MEDAN', 'ID', 'JKT'),
('MEX', 'MEXICO', 'MX', ''),
('MFM', 'MACAU', 'MO', ''),
('MGA', 'MANAGUA', 'NI', ''),
('MHD', 'MASHAD', 'IR', ''),
('MHQ', 'MARIEHAMN', 'FI', ''),
('MIA', 'MIAMI', 'US', ''),
('MIL', 'MILAN, ITALY', 'IT', ''),
('MIP', 'MANILA NORTH', 'PH', ''),
('MIZ', 'MIZHUSIMA', 'JP', ''),
('MKE', 'MILWAUKEE', 'US', ''),
('MKQ', 'MARAUKE', 'ID', ''),
('MKS', 'MAKASSAR', 'ID', 'SULAWESI'),
('MKW', 'MANOKWARI - PAPUA', 'ID', ''),
('MLA', 'MALTA', 'MT', ''),
('MLH', 'MULHOUSE', 'FR', ''),
('MLW', 'MONROVIA', 'LR', ''),
('MMA', 'MALMO', 'SE', ''),
('MND', 'MENADO', 'ID', 'SULAWESI'),
('MNL', 'MANILA SOUTH', 'PH', ''),
('MNO', 'MANADO', 'ID', ''),
('MOB', 'MOMBASA', 'KE', ''),
('MOW', 'MOSCOW', 'RU', ''),
('MRD', 'MERIDA', 'MX', ''),
('MRS', 'MARSEILLE', 'FR', ''),
('MRU', 'MAURITIUS', 'MU', ''),
('MSR', 'MUNSTER', 'DE', ''),
('MST', 'MAASTRICHT', 'NL', 'AMSTERDAM'),
('MSY', 'NEW  ORLEANS', 'US', ''),
('MTR', 'MATARAM - INDONESIA', 'ID', ''),
('MTY', 'MONTERREY', 'MX', ''),
('MUC', 'MUNICH', 'DE', ''),
('MUM', 'MUMBAI', 'IN', ''),
('MVD', 'MONTEVIDEO', 'UY', ''),
('MXL', 'MEXICALI', 'MX', 'MEXICO'),
('MXP', 'MALPENSA', 'IT', ''),
('MYJ', 'MATSUYAMA', 'JP', ''),
('MZT', 'MAZATLAN', 'MX', ''),
('NAG', 'NAGPUR', 'IN', 'INDIA'),
('NAN', 'NADI', 'FJ', ''),
('NAS', 'NASSAU', 'BS', ''),
('NBO', 'NINGBO', 'CN', ''),
('NCE', 'NICE', 'FR', ''),
('NCL', 'NEWCASTLE', 'GB', ''),
('NEA', 'NEW ORLEANS', 'LA', ''),
('NGB', 'NINGBO', 'CN', ''),
('NGO', 'NAGOYA', 'JP', ''),
('NHS', 'NHAVA SHEVA', 'IN', ''),
('NIC', 'NICOSIA', 'CY', ''),
('NKG', 'NANJING', 'CN', 'CHINA'),
('NNG', 'NANNING,GUANGXI', 'CN', ''),
('NOU', 'NOUMEA', 'NC', ''),
('NRK', 'NORRKOPING', 'SE', ''),
('NRT', 'NARITA', 'JP', ''),
('NTE', 'NANTES', 'FR', ''),
('NUE', 'NUEREMBERG', 'DE', ''),
('NWD', 'NEW DELHI', 'IN', ''),
('NWI', 'NORWICH', 'GB', ''),
('NWR', 'NEWARK, NEW JERSEY', 'US', 'USA'),
('NYC', 'NEW YORK', 'US', 'NY'),
('OAX', 'OAXACA', 'MX', ''),
('OKA', 'OKINAWA', 'JP', ''),
('OKC', 'OKLAHOMA', 'US', ''),
('OMA', 'OMAHA', 'US', ''),
('ONT', 'ONTARIO, CANADA', 'CA', ''),
('OPO', 'PORTO', 'PT', ''),
('ORD', 'CHICAGO', 'US', ''),
('ORK', 'CORK', 'IE', ''),
('ORL', 'ORLANDO FL,USA', 'US', ''),
('ORN', 'ORAN', 'DZ', ''),
('OSA', 'OSAKA', 'JP', ''),
('OSK', 'OSAKA, JAPANESE PORT', 'JP', ''),
('OSL', 'OSLO', 'NO', ''),
('OVB', 'NOVOSIBIRSK', 'XU', ''),
('PAP', 'PORT AU PRINC', 'HT', ''),
('PAR', 'PARIS', 'FR', ''),
('PBM', 'PARAMARIBO', 'SR', ''),
('PDG', 'PADANG', 'ID', ''),
('PDX', 'PORTLAND', 'US', ''),
('PEK', 'BEIJING', 'CN', ''),
('PEN', 'PENANG', 'MY', ''),
('PER', 'PERTH', 'AU', ''),
('PEW', 'PESHAWAR', 'PK', ''),
('PGM', 'PASIR GUDANG, MALAYSIA', 'MY', ''),
('PHL', 'PHILADELPHIA', 'US', ''),
('PHX', 'PHOENIX', 'US', ''),
('PIT', 'PITTSBURGH,PA,USA', 'US', ''),
('PKL', 'PORT KLANG,MALAYSIA', 'MY', ''),
('PKN', 'PANGKALAN BUN', 'ID', 'KALIMANTAN TENGAH'),
('PKU', 'PEKANBARU', 'ID', ''),
('PKW', 'PORT KLANG WEST', 'MY', ''),
('PKY', 'PALANGKARAYA', 'ID', 'KALIMANTAN TENGAH'),
('PLB', 'PALEMBANG', 'ID', 'INDONESIA'),
('PLM', 'PALEMBANG', 'ID', 'JAKARTA'),
('PLW', 'PALU', 'ID', ''),
('PLZ', 'PT ELIZABETH', 'ZA', ''),
('PMI', 'PALMA MALLORC', 'ES', ''),
('PMO', 'PALERMO', 'IT', ''),
('PNG', 'PARANAQUA', 'PH', ''),
('PNH', 'PHNOM PENH', 'KH', ''),
('PNK', 'PONTIANAK', 'ID', ''),
('PNL', 'PANTELLERIA', 'IT', ''),
('POM', 'PORT MORESBY', 'PG', ''),
('POS', 'PORT OF SPAIN', 'TT', ''),
('PPG', 'PAGO PAGO', 'AS', ''),
('PRG', 'PRAGUE', 'CZ', ''),
('PSR', 'PESCARA', 'IT', ''),
('PTP', 'POINTE A PITR', 'GP', ''),
('PTT', 'PAPEETE', 'PF', ''),
('PTY', 'PANAMA CITY', 'PA', ''),
('PUS', 'PUSAN', 'KR', ''),
('PVG', 'SHANGHAI', 'CN', 'CHINA'),
('PVR', 'PUERTO VALLAR', 'MX', ''),
('PZU', 'PORT OF SUDAN', 'SD', ''),
('QIN', 'QINGDAO .', 'CN', ''),
('QUA', 'QUAGADOUGOU', 'BF', ''),
('RAR', 'RAROTONGA', 'CK', ''),
('RBA', 'RABAT', 'MA', ''),
('REG', 'REGGIO CALAB', 'IT', ''),
('REK', 'REYKJAVIK', 'IS', ''),
('RGN', 'YANGOON', 'MM', ''),
('RIC', 'RICHMOND', 'US', 'US'),
('RIO', 'RIO DE JANEIRO', 'BR', ''),
('RIX', 'RIGA', 'LV', ''),
('RMI', 'RIMINI', 'IT', ''),
('ROM', 'ROMA', 'IT', ''),
('RTM', 'ROTTERDAM', 'NL', ''),
('RUH', 'RIYADH', 'SA', ''),
('SAH', 'SANAA', 'YE', ''),
('SAL', 'SAN SALVADOR', 'SV', ''),
('SAN', 'SAN DIEGO', 'US', ''),
('SAO', 'SAO PAULO', 'BR', ''),
('SAP', 'SAN PEDRO SUL', 'HN', ''),
('SAV', 'SAVANNAH', 'US', ''),
('SCK', 'SCKOTLAND', 'UK', ''),
('SCL', 'SANTIAGO', 'CL', ''),
('SCN', 'SAARBRUCKEN', 'DE', ''),
('SDJ', 'SENDAI', 'JP', ''),
('SDQ', 'SANTO DOMINGO', 'DO', ''),
('SEA', 'SEATTLE', 'US', ''),
('SEL', 'SEOUL', 'KR', ''),
('SFO', 'SAN FRANCISCO', 'US', ''),
('SFS', 'SUBIC BAY', 'PH', ''),
('SGN', 'HO CHI MINH', 'VN', ''),
('SHA', 'SHANGHAI', 'CN', ''),
('SHE', 'SHENZHEN', 'CN', ''),
('SHJ', 'SHARJAH', 'AE', ''),
('SHK', 'SHEKOU', 'CN', ''),
('SHY', 'SHENYANG', 'CN', ''),
('SIN', 'SINGAPORE', 'SG', ''),
('SJD', 'SAN JOSE CABO', 'MX', ''),
('SJO', 'SAN JOSE', 'CR', ''),
('SKB', 'ST KITTS', 'KN', ''),
('SKG', 'THESSALONIKI', 'GR', ''),
('SKP', 'SKOPJE', 'MK', ''),
('SLU', 'ST LUCIA', 'LC', ''),
('SMD', 'SAMARINDA', 'ID', 'KALIMANTAN TIMUR'),
('SMG', 'SEMARANG', 'ID', ''),
('SMQ', 'SAMPIT', 'ID', ''),
('SNN', 'SHANNON', 'IE', ''),
('SOF', 'SOFIA', 'BG', ''),
('SOL', 'SOLO', 'ID', ''),
('SON', 'ESPIRITU SANT', 'VU', ''),
('SOQ', 'SORONG, IRIAN JAYA', 'ID', ''),
('SOU', 'SOUTHGATE', 'US', 'UNITATE STATES'),
('SPD', 'SAN PEDRO, NEW YORK', 'US', ''),
('SPK', 'SAPPORO', 'JP', ''),
('SRG', 'SEMARANG', 'ID', ''),
('SSG', 'MALABO', 'GQ', ''),
('STL', 'SAINT LOUIS', 'US', ''),
('STO', 'STOCKHOLM', 'SE', ''),
('STP', 'ST PETERBURG', 'RU', ''),
('STR', 'STUTTGART', 'DE', ''),
('SUB', 'SURABAYA', 'ID', ''),
('SUV', 'SUVA', 'FJ', ''),
('SVD', 'ST VINCENT', 'VC', ''),
('SVG', 'STAVANGER', 'NO', ''),
('SVO', 'MOSCOW', 'RU', ''),
('SVQ', 'SEVILLE', 'ES', ''),
('SWD', 'SWEDEN', 'SE', ''),
('SXB', 'STRASBOURG', 'FR', ''),
('SXM', 'ST MAARTEN', 'AN', ''),
('SYD', 'SYDNEY', 'AU', 'AUSTRALIA'),
('SYX', 'SANYA HAINAN', 'CN', ''),
('SZG', 'SALZBURG', 'AT', ''),
('SZX', 'SHENZHEN, CHINA', 'CN', ''),
('TAL', 'TALLIN', 'EE', ''),
('TAM', 'TAMPICO', 'MX', ''),
('TAO', 'QINGDAO', 'CN', ''),
('TAP', 'TOBAGO', 'IT', ''),
('TBL', 'TOBELO', 'ID', ''),
('TBS', 'TBILISI', 'GE', ''),
('TCH', 'TAICHUNG, TAIWAN', 'TW', ''),
('TCI', 'TENERIFE', 'ES', ''),
('TER', 'TERCEIRA IS', 'PT', ''),
('TGM', 'TG. MAS, SEMARANG', 'ID', 'SEMARANG'),
('TGP', 'TG. PRIOK,JAKARTA', 'ID', 'JKT'),
('TGR', 'TANJUNG PRIOK, *)', 'ID', 'JAKARTA'),
('TGU', 'TEGUCIGALPA', 'HN', ''),
('THR', 'TEHERAN', 'IR', ''),
('TIA', 'TIRANA', 'AL', ''),
('TIJ', 'TIANJIN', 'CN', 'CHINA'),
('TIM', 'TIMIKA', 'ID', 'IRIAN JAYA'),
('TIP', 'TRIPOLI', 'LY', ''),
('TJQ', 'TANJUNG PANDAN BELITUNG', 'ID', ''),
('TKG', 'BANDAR LAMPUNG', 'ID', ''),
('TKU', 'TURKU', 'FI', ''),
('TLL', 'TALLINN', 'EE', ''),
('TLS', 'TOULOUSE', 'FR', ''),
('TLV', 'TEL AVIV YAFO', 'IL', ''),
('TMG', 'TANGIER', 'MA', ''),
('TMK', 'TOMAKOMAI', 'JP', ''),
('TMP', 'TAMPERE', 'FI', ''),
('TNA', 'JINAN CITY CHINA', 'CN', ''),
('TNG', 'TANGERANG', 'ID', ''),
('TNJ', 'RIAU', 'ID', 'INDONESIA'),
('TNT', 'TERNATE', 'ID', ''),
('TOM', 'TOMAKOMAI', 'JP', ''),
('TPA', 'TAMPA', 'US', 'FLA'),
('TPE', 'TAIPEI', 'TW', 'TAIWAN'),
('TPS', 'TRAPANI', 'IT', ''),
('TRK', 'TARAKAN', 'ID', ''),
('TRN', 'TURIN', 'IT', ''),
('TRS', 'TRIESTE', 'IT', ''),
('TSN', 'TIANJIN', 'CN', ''),
('TSV', 'TOWNSVILLE', 'AU', ''),
('TUN', 'TUNIS', 'TN', ''),
('TXG', 'TAICHUNG', 'TW', ''),
('TXL', 'BERLIN TEGEL', 'DE', ''),
('TYJ', 'TOKYO, JAPANESE PORT', 'JP', ''),
('TYL', 'TALARA', 'PE', ''),
('TYN', 'TAOYUAN', 'TW', ''),
('TYO', 'TOKYO', 'JP', ''),
('UIO', 'QUITO', 'EC', ''),
('UKB', 'KOBE', 'JP', ''),
('UPG', 'UJUNG PANDANG', 'ID', 'INDONESIA'),
('USN', 'ULSAN', 'KR', ''),
('VAD', 'VADODARA', 'IN', 'INDIA'),
('VCE', 'VENICE', 'IT', ''),
('VCP', 'VIRACOPOS,BRAZIL', 'DE', ''),
('VIE', 'VIENNA', 'AT', ''),
('VLC', 'VALENCIA', 'ES', ''),
('VNO', 'VILNIUS', 'LT', ''),
('VRN', 'VERONA', 'IT', ''),
('VST', 'VASTERAS', 'SE', ''),
('VTE', 'VIENTIANE, LAOS', 'VT', ''),
('VVO', 'VLADIVOSTOK', 'RU', ''),
('VYP', 'VOSTOCHNIY', 'RU', ''),
('WAR', 'WARRENTON', 'US', ''),
('WAW', 'WARSAWA', 'PL', ''),
('WDH', 'WINDHOEK', 'NA', ''),
('WLG', 'WELLINGTON', 'NZ', ''),
('WOL', 'WOLFURT,AUSTRIA', 'AT', ''),
('WUH', 'WUHAN', 'CN', ''),
('XGG', 'XINGANG', 'CN', ''),
('XIG', 'XINGANG', 'CH', 'TIANJIN'),
('XMN', 'XIAMEN', 'CN', ''),
('YAN', 'YANTAI, CHINA', 'CN', ''),
('YOG', 'YOGYAKARTA', 'ID', 'JAWA TENGAH'),
('YOK', 'YOKOHAMA', 'JP', ''),
('YTN', 'YANTIAN', 'CN', ''),
('YUL', 'MONTREAL', 'CA', ''),
('YVA', 'MORONI', 'KM', ''),
('YVL', 'VANCOUVER', 'CA', ''),
('YVR', 'VANCOUVER', 'CA', ''),
('YWG', 'WINNIPEG', 'CA', ''),
('YYZ', 'TORONTO', 'CA', ''),
('ZAG', 'ZAGREB', 'HR', ''),
('ZAZ', 'ZARAGOZA', 'ES', ''),
('ZHU', 'ZHU HAI', 'CN', 'CHINA'),
('ZNZ', 'ZANZIBAR', 'TZ', ''),
('ZRH', 'ZURICH', 'CH', '');

-- --------------------------------------------------------

--
-- Table structure for table `mscommodity`
--

CREATE TABLE `mscommodity` (
  `Id` varchar(10) NOT NULL DEFAULT '',
  `Desc` varchar(50) NOT NULL DEFAULT '',
  `IdService` varchar(10) NOT NULL DEFAULT '',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `CreatedDate` datetime NOT NULL DEFAULT '2010-01-01 00:00:00',
  `ModifiedBy` varchar(50) NOT NULL DEFAULT '',
  `ModifiedDate` datetime NOT NULL DEFAULT '2010-01-01 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mscommodity`
--

INSERT INTO `mscommodity` (`Id`, `Desc`, `IdService`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
('0001', 'Genco', '001', 'admin', '2010-01-01 00:00:00', '', '2010-01-01 00:00:00'),
('0002', 'Others', '002', 'admin', '2010-01-01 00:00:00', '', '2010-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mscountry`
--

CREATE TABLE `mscountry` (
  `Id` char(2) NOT NULL DEFAULT '',
  `name` varchar(250) NOT NULL DEFAULT '',
  `IdRegion` char(3) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mscountry`
--

INSERT INTO `mscountry` (`Id`, `name`, `IdRegion`) VALUES
('AG', 'ANTIGUA AND BARBUDA', ''),
('AI', 'ANGUILLA', ''),
('AL', 'ALBANIA', ''),
('AM', 'ARMENIA', ''),
('AN', 'NETHERLANDS ANTILLES', ''),
('AO', 'ANGOLA', ''),
('AR', 'ARGENTINA', ''),
('AS', 'AMERICAN SAMOA', ''),
('AT', 'AUSTRIA', ''),
('AU', 'AUSTRALIA', ''),
('AW', 'ARUBA', ''),
('AZ', 'AZERBAIJAN', ''),
('BA', 'BOSNIA AND HERZEGOVINA', ''),
('BB', 'BARBADOS', ''),
('BD', 'BANGLADESH', ''),
('BE', 'BELGIUM', ''),
('BF', 'BURKINA FASO', ''),
('BG', 'BULGARIA', ''),
('BH', 'BAHRAIN', ''),
('BI', 'BURUNDI', ''),
('BJ', 'BENIN', ''),
('BK', 'ML', ''),
('BL', 'IT', ''),
('BM', 'BERMUDA', ''),
('BN', 'BRUNEI DARUSSALAM', ''),
('BO', 'BOLIVIA', ''),
('BR', 'BRAZIL', ''),
('BS', 'BAHAMAS', ''),
('BT', 'BHUTAN', ''),
('BW', 'BOTSWANA', ''),
('BY', 'BELARUS', ''),
('BZ', 'BELIZE', ''),
('CA', 'CANADA', ''),
('CC', 'COCOS (KEELING) ISLANDS', ''),
('CD', 'CONGO (KINSHASA)', ''),
('CF', 'CENTRAL AFRICAN REP', ''),
('CG', 'CONGO (BRAZZAVILLE)', ''),
('CH', 'SWITZERLAND', ''),
('CI', 'COTE D''IVOIRE', ''),
('CK', 'COOK ISLANDS', ''),
('CL', 'CHILE', ''),
('CM', 'CAMEROON', ''),
('CN', 'CHINA', ''),
('CO', 'COLOMBIA', ''),
('CR', 'COSTA RICA', ''),
('CU', 'CUBA', ''),
('CV', 'CAPE VERDE', ''),
('CX', 'CHRISTMAS ISLANDS', ''),
('CY', 'CYPRUS', ''),
('CZ', 'CZECH REPUBLIC', ''),
('DE', 'GERMANY', ''),
('DJ', 'DJIBOUTI', ''),
('DK', 'DENMARK', ''),
('DM', 'DOMINICA', ''),
('DO', 'DOMINICAN REPUBLIC', ''),
('DZ', 'ALGERIA', ''),
('EC', 'ECUADOR', ''),
('EE', 'ESTONIA', ''),
('EG', 'EGYPT', ''),
('ER', 'ERITREA', ''),
('ES', 'SPAIN', ''),
('ET', 'ETHIOPIA', ''),
('FI', 'FINLAND', ''),
('FJ', 'FIJI', ''),
('FK', 'FALKLAND ISLANDS', ''),
('FM', 'MICRONESIA', ''),
('FO', 'FAROE ISLANDS', ''),
('FR', 'FRANCE', ''),
('GA', 'GABON', ''),
('GB', 'UNITED KINGDOM', ''),
('GD', 'GRENADA', ''),
('GE', 'GEORGIA', ''),
('GF', 'FRENCH GUIANA', ''),
('GH', 'GHANA', ''),
('GI', 'GIBRALTAR', ''),
('GL', 'GREENLAND', ''),
('GM', 'GAMBIA', ''),
('GN', 'GUINEA', ''),
('GP', 'GUADELOUPE (ST. BARTHELEMY & ST MARTIN)', ''),
('GQ', 'EQUATORIAL GUINEA', ''),
('GR', 'GREECE', ''),
('GS', 'SOUTH GEORGIA & SOUTH SANDWICH ISLANDS', ''),
('GT', 'GUATEMALA', ''),
('GU', 'GUAM', ''),
('GW', 'GUINEA-BISSAU', ''),
('GY', 'GUYANA', ''),
('HF', 'HAIFA', ''),
('HK', 'HONGKONG', ''),
('HN', 'HONDURAS', ''),
('HO', 'HOUSTON , TEXAS', ''),
('HR', 'CROATIA', ''),
('HT', 'HAITI', ''),
('HU', 'HUNGARY', ''),
('ID', 'INDONESIA', ''),
('IE', 'IRELAND', ''),
('IL', 'ISRAEL', ''),
('IN', 'INDIA (INCL ANDAMAN ISLAND)', ''),
('IQ', 'IRAQ', ''),
('IR', 'IRAN (ISLAMIC REPUBLIC OF)', ''),
('IS', 'ICELAND', ''),
('IT', 'ITALY', ''),
('JM', 'JAMAICA', ''),
('JO', 'JORDAN', ''),
('JP', 'JAPAN', ''),
('KE', 'KENYA', ''),
('KG', 'KYRGYZSTAN', ''),
('KH', 'CAMBODIA', ''),
('KI', 'KIRIBATI', ''),
('KM', 'COMOROS', ''),
('KN', 'ST KITTS & NEVIS', ''),
('KP', 'NORTH KOREA', ''),
('KR', 'KOREA', ''),
('KW', 'KUWAIT', ''),
('KY', 'CAYMAN ISLANDS', ''),
('KZ', 'KAZAKSTAN', ''),
('LA', 'LAOS', ''),
('LB', 'LEBANON', ''),
('LC', 'ST LUCIA', ''),
('LI', 'LIECHTENSTEIN', ''),
('LK', 'SRI LANKA', ''),
('LR', 'LIBERIA', ''),
('LS', 'LESOTHO', ''),
('LT', 'LITHUANIA', ''),
('LU', 'LUXEMBOURG', ''),
('LV', 'LATVIA', ''),
('LW', 'LVIV UKRAINE', ''),
('LY', 'LIBYA', ''),
('MA', 'MOROCCO', ''),
('MC', 'MONACO', ''),
('MD', 'MOLDOVA', ''),
('MG', 'MADAGASKAR', ''),
('MH', 'MARSHALL ISLANDS', ''),
('MK', 'MACEDONIA', ''),
('ML', 'MALI', ''),
('MM', 'MYANMAR', ''),
('MN', 'MONGOLIA', ''),
('MO', 'MACAU', ''),
('MP', 'NORTHERN MARIANA ISLANDS', ''),
('MQ', 'MARTINIQUE', ''),
('MR', 'MAURITANIA', ''),
('MS', 'MONTSERRAT', ''),
('MT', 'MALTA', ''),
('MU', 'MAURITIUS', ''),
('MV', 'MALDIVES', ''),
('MW', 'MALAWI', ''),
('MX', 'MEXICO', ''),
('MY', 'MALAYSIA', ''),
('MZ', 'MOZAMBIQUE', ''),
('NA', 'NAMIBIA', ''),
('NC', 'NEW CALEDONIA', ''),
('NE', 'NIGER', ''),
('NF', 'NORFOLK ISLAND', ''),
('NG', 'NIGERIA', ''),
('NI', 'NICARAGUA', ''),
('NL', 'NETHERLANDS', ''),
('NO', 'NORWAY', ''),
('NP', 'NEPAL', ''),
('NR', 'NAURU', ''),
('NU', 'NIUE', ''),
('NZ', 'NEW ZEALAND', ''),
('OM', 'OMAN', ''),
('PA', 'PANAMA', ''),
('PE', 'PERU', ''),
('PF', 'FRENCH POLYNESIA', ''),
('PG', 'PAUA NEW GUINEA', ''),
('PH', 'PHILIPPINES', ''),
('PK', 'PAKISTAN', ''),
('PL', 'POLAND', ''),
('PM', 'ST PIERRE & MIQUELON', ''),
('PN', 'PITCAIRN', ''),
('PR', 'PUERTO RICO', ''),
('PS', 'PALESTINA', ''),
('PT', 'PORTUGAL', ''),
('PW', 'PALAU', ''),
('PY', 'PARAGUAY', ''),
('QA', 'QATAR', ''),
('RE', 'REUNION', ''),
('RO', 'ROMANIA', ''),
('RU', 'RUSSIAN FEDERATION (WEST)', ''),
('RW', 'RWANDA', ''),
('SA', 'SAUDI ARABIA', ''),
('SB', 'SOLOMON ISLANDS', ''),
('SC', 'SEYCHELLES', ''),
('SD', 'SUDAN', ''),
('SE', 'SWEDEN', ''),
('SG', 'SINGAPORE', ''),
('SH', 'ST HELENA', ''),
('SI', 'SLOVENIA', ''),
('SJ', 'SVALBARD & JAN MAYEN ISLANDS', ''),
('SK', 'SLOVAKIA', ''),
('SL', 'SIERRA LEONE', ''),
('SM', 'SAN MARINO', ''),
('SN', 'SENEGAL', ''),
('SO', 'SOMALIA', ''),
('SR', 'SURINAME', ''),
('ST', 'SAO TOME & PRINCIPE', ''),
('SV', 'EL SAVADOR', ''),
('SY', 'SYRIA', ''),
('SZ', 'SWAZILAND', ''),
('TC', 'TURKS & CAICOS ISLANDS', ''),
('TD', 'CHAD', ''),
('TG', 'TOGO', ''),
('TH', 'THAILAND', ''),
('TJ', 'TAJIKISTAN', ''),
('TK', 'TOKELAU', ''),
('TM', 'TURKMENISTAN', ''),
('TN', 'TUNISIA', ''),
('TO', 'TONGA', ''),
('TP', 'EAST TIMOR', ''),
('TR', 'TURKEY', ''),
('TT', 'TRINIDAD & TOBAGO', ''),
('TV', 'TUVALU', ''),
('TW', 'TAIWAN', ''),
('TZ', 'TANZANIA', ''),
('UA', 'UKRAINE', ''),
('UG', 'UGANDA', ''),
('UK', 'UNITED KINGDOM', ''),
('UM', 'UNITED STATES MINOR OUTLYING ISLANDS', ''),
('US', 'UNITED STATES', ''),
('UY', 'URUGUAY', ''),
('UZ', 'UZBEKISTAN', ''),
('VA', 'VADODARA,INDIA', ''),
('VC', 'ST VINCENT & THE GRENADINES', ''),
('VE', 'VENEZUELA', ''),
('VG', 'VIRGIN ISLANDS (BRITISH)', ''),
('VI', 'VIRGIN ISLANDS (US)', ''),
('VN', 'VIETNAM', ''),
('VU', 'VANUATU', ''),
('WF', 'WALLIS & FUTUNA ISLANDS', ''),
('WS', 'SAMOA', ''),
('XU', 'RUSSIAN FEDERATION (EAST)', ''),
('YE', 'YEMEN', ''),
('YT', 'MAYOTTE', ''),
('YU', 'YUGOSLAVIA', ''),
('ZA', 'SOUTH AFRICA', ''),
('ZM', 'ZAMBIA', ''),
('ZW', 'ZIMBABWE', '');

-- --------------------------------------------------------

--
-- Table structure for table `mscurrency`
--

CREATE TABLE `mscurrency` (
  `Id` char(3) NOT NULL DEFAULT '',
  `Name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mscurrency`
--

INSERT INTO `mscurrency` (`Id`, `Name`) VALUES
('EUR', 'EURO'),
('IDR', 'RUPIAH'),
('JPY', 'YEN'),
('RMB', 'YUAN'),
('SGD', 'SINGAPORE DOLLAR'),
('USD', 'UNITED STATES DOLLAR');

-- --------------------------------------------------------

--
-- Table structure for table `msport`
--

CREATE TABLE `msport` (
  `Id` varchar(10) NOT NULL DEFAULT '',
  `Codes` varchar(5) NOT NULL DEFAULT '',
  `Name` varchar(50) NOT NULL DEFAULT '',
  `IdCity` char(3) NOT NULL DEFAULT '',
  `IdService` varchar(10) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msport`
--

INSERT INTO `msport` (`Id`, `Codes`, `Name`, `IdCity`, `IdService`) VALUES
('00111480', '11480', 'SLIPI,PALMERAH,KEMANGGISAN', 'JKT', '001'),
('005CGK', 'CGK', 'SOEKARNO HATTA INTL AIRPORT', 'JKT', '005'),
('005JFK', 'JFK', 'JOHN F. KENNEDY INTL AIRPORT', 'NYC', '005'),
('005LAX', 'LAX', 'LOS ANGELES INTL AIRPORT', 'LAX', '005'),
('005NRT', 'NRT', 'NARITA INTL AIRPORT', 'NRT', '005'),
('006SHA', 'SHA', 'SHANGHAI SEAPORT', 'SHA', '006'),
('006TPP', 'TPP', 'TANJUNG PRIOK SEAPORT', 'JKT', '006'),
('006VVO', 'VVO', 'VLADIOSTOCK SEAPORT', 'VVO', '006');

-- --------------------------------------------------------

--
-- Table structure for table `msregion`
--

CREATE TABLE `msregion` (
  `Id` char(3) NOT NULL DEFAULT '',
  `Name` varchar(100) NOT NULL DEFAULT '' COMMENT 'Name of region according IATA',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `CreatedDate` date NOT NULL DEFAULT '2016-01-01',
  `ModifiedBy` varchar(50) NOT NULL DEFAULT '',
  `ModifiedDate` date NOT NULL DEFAULT '2016-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msregion`
--

INSERT INTO `msregion` (`Id`, `Name`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
('AFR', 'Africa', 'Admin', '2016-01-01', '', '2016-01-01'),
('CEM', 'Centra America', 'Admin', '2016-01-01', '', '2016-01-01'),
('EUR', 'Europe', 'Admin', '2016-01-01', '', '2016-01-01'),
('JAK', 'Japan and Korea', 'Admin', '2016-01-01', '', '2016-01-01'),
('MDE', 'Middle East', 'Admin', '2016-01-01', '', '2016-01-01'),
('NOA', 'North America', 'Admin', '2016-01-01', '', '2016-01-01'),
('SAS', 'South Asia', 'Admin', '2016-01-01', '', '2016-01-01'),
('SEA', 'South-Eastern Asia', 'Admin', '2016-01-01', '', '2016-01-01'),
('SOA', 'South America', 'Admin', '2016-01-01', '', '2016-01-01'),
('SWP', 'South-West Pacific', 'Admin', '2016-01-01', '', '2016-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `msservice`
--

CREATE TABLE `msservice` (
  `Id` varchar(10) NOT NULL DEFAULT '',
  `Name` varchar(50) NOT NULL DEFAULT '',
  `IdServiceCategory` varchar(10) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msservice`
--

INSERT INTO `msservice` (`Id`, `Name`, `IdServiceCategory`) VALUES
('001', 'ORIGIN COURIER', '001'),
('002', 'PACKAGING', '001'),
('003', 'FUMIGASI', '001'),
('004', 'KARANTINA', '001'),
('005', 'AIR FREIGHT', '003'),
('006', 'SEA FREIGHT', '003'),
('007', 'ORIGIN CUSTOMS CLEARANCE', '002'),
('008', 'DESTINATION CUSTOMS CLEARANCE', '004'),
('009', 'DELIVERY COURIER', '005'),
('010', 'LINE FREIGHT', '003');

-- --------------------------------------------------------

--
-- Table structure for table `msservice_category`
--

CREATE TABLE `msservice_category` (
  `Id` varchar(10) NOT NULL DEFAULT '',
  `Name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msservice_category`
--

INSERT INTO `msservice_category` (`Id`, `Name`) VALUES
('001', 'PICKUP'),
('002', 'ORIGIN CUSTOMS'),
('003', 'FREIGHT'),
('004', 'DESTINATION CUSTOMS'),
('005', 'DELIVERY');

-- --------------------------------------------------------

--
-- Table structure for table `msvat_type`
--

CREATE TABLE `msvat_type` (
  `Id` varchar(10) NOT NULL DEFAULT '' COMMENT 'master dari tipe VAT, 1%, 10% akan dilink ke itemcharges',
  `Name` varchar(50) NOT NULL DEFAULT '',
  `Value` double NOT NULL DEFAULT '0',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `CreatedDate` datetime NOT NULL DEFAULT '2010-01-01 00:00:00',
  `ModifiedBy` varchar(50) NOT NULL DEFAULT '',
  `ModifiedDate` datetime NOT NULL DEFAULT '2010-01-01 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trcust_dtlaccounting`
--

CREATE TABLE `trcust_dtlaccounting` (
  `Id` varchar(20) NOT NULL DEFAULT '',
  `IdCustHeader` varchar(20) NOT NULL DEFAULT '',
  `IdCOAAR` varchar(50) NOT NULL DEFAULT '',
  `IdCOAGiro` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trcust_dtladdress`
--

CREATE TABLE `trcust_dtladdress` (
  `Id` varchar(20) NOT NULL DEFAULT '' COMMENT 'Detil address of company',
  `IdCustHeader` varchar(20) NOT NULL DEFAULT '',
  `IdAddrType` varchar(10) NOT NULL DEFAULT '' COMMENT 'Type of Address, link msaddr type',
  `Address` text COMMENT 'Keep information of Addresses',
  `Postal` varchar(10) NOT NULL DEFAULT '',
  `Telp1` varchar(20) NOT NULL DEFAULT '',
  `Telp2` varchar(20) NOT NULL DEFAULT '',
  `Fax` varchar(10) NOT NULL DEFAULT '',
  `isDefault` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Jika 1 maka ini yg akan muncul di header inf',
  `Remarks` text COMMENT 'Remarks of the addresses (warehouse/head office/branch)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trcust_dtladdress`
--

INSERT INTO `trcust_dtladdress` (`Id`, `IdCustHeader`, `IdAddrType`, `Address`, `Postal`, `Telp1`, `Telp2`, `Fax`, `isDefault`, `Remarks`) VALUES
('1', '23', '0003', '23', '32', '24', '43', '42', 1, ''),
('11', '23', '0001', 'jakarta selatan', '11232', '454545', '09090909', '7667', 1, 'Keterangan alamat fdfdfdf\r\n'),
('2', '23', '0002', 'jakarta utara', '99872', '544546', '65656562', '454545', 1, 'ngfghgfhgfhgfhgforem ipsum dolor sit amet\r\n'),
('22', '23', '0001', 'tgjnjfn', '656', '656', '564645', '7878', 1, 'fbgsdgdfrhgdfrhdh');

-- --------------------------------------------------------

--
-- Table structure for table `trcust_dtlbilling`
--

CREATE TABLE `trcust_dtlbilling` (
  `Id` varchar(20) NOT NULL DEFAULT '',
  `IdCurr` char(3) NOT NULL DEFAULT '' COMMENT 'Curreny',
  `IdCustHeader` varchar(20) NOT NULL DEFAULT '',
  `PaymentTerm` varchar(10) NOT NULL DEFAULT '' COMMENT 'Term payment (day)',
  `CreditLimit` double NOT NULL DEFAULT '0',
  `BankName` varchar(50) NOT NULL DEFAULT '',
  `BankAddress` varchar(200) NOT NULL DEFAULT '',
  `Swift` varchar(50) NOT NULL DEFAULT '',
  `BankAccNo` varchar(50) NOT NULL DEFAULT '',
  `Remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trcust_dtlbusiness`
--

CREATE TABLE `trcust_dtlbusiness` (
  `Id` varchar(20) NOT NULL DEFAULT '' COMMENT 'inf ttg tipe bisnis cust: agent/shipper dll',
  `IdCustHeader` varchar(20) NOT NULL DEFAULT '',
  `IdBusinessType` varchar(5) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trcust_dtlbusiness`
--

INSERT INTO `trcust_dtlbusiness` (`Id`, `IdCustHeader`, `IdBusinessType`) VALUES
('1', '23', '0002'),
('2', '23', '0005'),
('3', '23', '0003');

-- --------------------------------------------------------

--
-- Table structure for table `trcust_dtlcomm`
--

CREATE TABLE `trcust_dtlcomm` (
  `Id` varchar(20) NOT NULL DEFAULT '' COMMENT 'inf ttg commodity2 customer',
  `IdCustHeader` varchar(20) NOT NULL DEFAULT '',
  `IdComm` varchar(10) NOT NULL DEFAULT '',
  `Remarks` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trcust_dtlcomm`
--

INSERT INTO `trcust_dtlcomm` (`Id`, `IdCustHeader`, `IdComm`, `Remarks`) VALUES
('1', '23', '0002', NULL),
('2', '23', '0001', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trcust_dtlcompetitor`
--

CREATE TABLE `trcust_dtlcompetitor` (
  `Id` varchar(20) NOT NULL DEFAULT '' COMMENT 'Inf ttg competitor yg aktif di customer',
  `IdCustHeader` varchar(20) NOT NULL DEFAULT '',
  `Name` varchar(200) NOT NULL DEFAULT '',
  `Address` varchar(200) NOT NULL DEFAULT '',
  `Telp` varchar(20) NOT NULL DEFAULT '',
  `PIC` varchar(50) NOT NULL DEFAULT '',
  `Remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trcust_dtlcompetitor_service`
--

CREATE TABLE `trcust_dtlcompetitor_service` (
  `Id` varchar(20) NOT NULL DEFAULT '' COMMENT 'Inf ttg service2 competitor',
  `IdCompetitor` varchar(20) NOT NULL DEFAULT '',
  `IdService` varchar(10) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trcust_dtlcontact`
--

CREATE TABLE `trcust_dtlcontact` (
  `Id` varchar(20) NOT NULL DEFAULT '' COMMENT 'Inf ttg contact2 milik cust',
  `IdCustHeader` varchar(20) NOT NULL DEFAULT '',
  `Name` varchar(200) NOT NULL DEFAULT '',
  `Position` varchar(200) NOT NULL DEFAULT '',
  `Email` varchar(200) NOT NULL DEFAULT '',
  `Telp1` varchar(20) NOT NULL DEFAULT '',
  `Telp2` varchar(20) NOT NULL DEFAULT '',
  `Fax` varchar(20) NOT NULL DEFAULT '',
  `Birthday` date NOT NULL DEFAULT '0000-00-00',
  `Remarks` text NOT NULL,
  `isDefault` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Default contact inf'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trcust_dtlcontact_active`
--

CREATE TABLE `trcust_dtlcontact_active` (
  `Id` varchar(20) NOT NULL DEFAULT '' COMMENT 'informasi ttg Customer Contact aktif diservice apa',
  `IdContactHeader` varchar(20) NOT NULL DEFAULT '',
  `IdService` varchar(10) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trcust_dtlphoto`
--

CREATE TABLE `trcust_dtlphoto` (
  `Id` varchar(20) NOT NULL DEFAULT '' COMMENT 'Information of company foto & video',
  `IdCustHeader` varchar(20) NOT NULL DEFAULT '',
  `PathPhoto` varchar(200) NOT NULL DEFAULT '' COMMENT 'File location of photo',
  `PathVideo` varchar(200) NOT NULL DEFAULT '' COMMENT 'File location of video',
  `Remarks` varchar(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trcust_dtlsales`
--

CREATE TABLE `trcust_dtlsales` (
  `Id` varchar(20) NOT NULL DEFAULT '' COMMENT 'Inf ttg sales person u/ cust tsb',
  `IdCustHeader` varchar(20) NOT NULL DEFAULT '',
  `IdService` varchar(10) NOT NULL DEFAULT '',
  `IdSales` varchar(20) NOT NULL DEFAULT '',
  `Remarks` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trcust_dtlsales`
--

INSERT INTO `trcust_dtlsales` (`Id`, `IdCustHeader`, `IdService`, `IdSales`, `Remarks`) VALUES
('1', '23', '004', '1', 'lorem ipsum dolor sit amet'),
('2', '23', '003', '2', 'testing ajah'),
('3', '23', '008', '2', 'testing remasrks'),
('54', '23', '010', 'rtrt', 'testing again');

-- --------------------------------------------------------

--
-- Table structure for table `trcust_dtlservice`
--

CREATE TABLE `trcust_dtlservice` (
  `Id` varchar(20) NOT NULL DEFAULT '' COMMENT 'Inf ttg service2 yg digunakan cust',
  `IdCustHeader` varchar(20) NOT NULL DEFAULT '' COMMENT 'Relasi dgn company header',
  `IdService` varchar(10) NOT NULL DEFAULT '' COMMENT 'Relasi dgn msservice'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trcust_hdr`
--

CREATE TABLE `trcust_hdr` (
  `Id` varchar(20) NOT NULL DEFAULT '' COMMENT 'kode pt MMyyyy9999',
  `Name` varchar(200) NOT NULL DEFAULT '',
  `IdCity` char(3) NOT NULL DEFAULT '' COMMENT 'Master City',
  `IdCountry` char(2) NOT NULL DEFAULT '' COMMENT 'Master Country',
  `VATNo` varchar(50) NOT NULL DEFAULT '' COMMENT 'No Pajak Perusahaan',
  `Email` varchar(100) DEFAULT NULL,
  `YearEst` varchar(10) DEFAULT NULL,
  `CompanyInf` text COMMENT 'brief description about company',
  `Website` varchar(50) DEFAULT NULL,
  `TotEmployee` int(4) DEFAULT NULL,
  `IdHolding` varchar(20) DEFAULT NULL COMMENT 'information of Holding company, idcustomer',
  `isActive` enum('1','0') DEFAULT NULL,
  `ActiveDate` date NOT NULL DEFAULT '2010-01-01' COMMENT 'Date of customer Active',
  `LogoPic` varchar(200) DEFAULT NULL COMMENT 'Path of file cust logo',
  `Status` varchar(50) NOT NULL DEFAULT '"customer","prospect"' COMMENT 'Information of cust status : Customer / Prospect',
  `PswdFrontend` varchar(50) DEFAULT NULL COMMENT 'password of customer fronteend',
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `CreatedDate` datetime NOT NULL DEFAULT '2016-01-01 00:00:00',
  `ModifiedBy` varchar(50) NOT NULL DEFAULT '',
  `ModifiedDate` datetime NOT NULL DEFAULT '2016-01-01 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trcust_hdr`
--

INSERT INTO `trcust_hdr` (`Id`, `Name`, `IdCity`, `IdCountry`, `VATNo`, `Email`, `YearEst`, `CompanyInf`, `Website`, `TotEmployee`, `IdHolding`, `isActive`, `ActiveDate`, `LogoPic`, `Status`, `PswdFrontend`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
('21', 'PT SURYA abadi', 'BPN', 'ID', 'dgvdfgdf', 'gdfgd', 'gfdgfdg', 'lorem ipsum dolor sit amet                                                                                                                                                                ', 'www.myweb.com', 55, 'n', '1', '2010-01-01', 'avatar.png', 'Customer', 'fdgdfg', 'dfg', '2016-01-01 00:00:00', 'dgdf', '2016-01-01 00:00:00'),
('22', 'HOLDING COMPANY', 'CGK', 'ID', 'aaa', 'bbbb', 'kkk', 'dfgdfgvdfgdfgdfgd', 'eee', 21, 'ww', '0', '2010-01-01', 'avatar.png', 'Customer ', 'fdgdfg', 'dfg', '2016-01-01 00:00:00', 'ooo', '2016-01-01 00:00:00'),
('23', 'PT. ATT Group Company', 'JKT', 'ID', '12600123', 'admin@attgroup.com', '2016-11-23', 'testing lorem ispum dolor sita amet                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ', 'www.attgroup.com', 300, 'T980', '1', '2010-01-05', 'avatar.png', 'Customer ', 'fdgdfg', 'dfg', '2016-01-01 00:00:00', 'ggg', '2016-01-01 00:00:00'),
('24', 'PT MAJU TERUS', 'BPN', 'ID', 'ff', 'ee', 'ddd', 'dfgdfgvdfgdfgdfgd', 'ggg', 32, 'yy', '1', '2010-01-01', 'avatar.png', 'Customer ', 'fdgdfg', 'dfg', '2016-01-01 00:00:00', 'dddd', '2016-01-01 00:00:00'),
('25', 'MANDIRI JAYA', 'CNJ', 'ID', 'aaa', 'bbbb', 'kkk', 'dfgdfgvdfgdfgdfgd', 'eee', 33, 'ww', '0', '2010-01-01', 'avatar.png', 'Customer ', 'fdgdfg', 'dfg', '2016-01-01 00:00:00', 'ooo', '2016-01-01 00:00:00'),
('26', 'PT SUPER POWER', 'BPN', 'ID', 'aaa', 'bbbb', 'kkk', 'dfgdfgvdfgdfgdfgd', 'eee', 12, 'ww', '1', '2010-01-01', 'avatar.png', 'Prospect', 'fdgdfg', 'dfg', '2016-01-01 00:00:00', 'ooo', '2016-01-01 00:00:00'),
('27', 'PT TORABIKA', 'CNJ', 'ID', 'aaa', 'bbbb', 'kkk', 'dfgdfgvdfgdfgdfgd', 'eee', 15, 'ww', '1', '2010-01-01', 'avatar.png', 'Prospect', 'fdgdfg', 'dfg', '2016-01-01 00:00:00', 'ooo', '2016-01-01 00:00:00'),
('28', 'PT SENTOSA', 'CGK', 'ID', 'aaa', 'bbbb', 'kkk', 'dfgdfgvdfgdfgdfgd', 'eee', 76, 'ww', '1', '2010-01-01', 'avatar.png', 'Customer', 'fdgdfg', 'dfg', '2016-01-01 00:00:00', 'ooo', '2016-01-01 00:00:00'),
('29', 'PT ABC', 'BTJ', 'ID', 'aaa', 'bbbb', 'kkk', 'testng                                                                                                                                                                                                ', 'eee', 30, 'ww', '1', '2010-01-01', 'avatar.png', 'Prospect', 'fdgdfg', 'dfg', '2016-01-01 00:00:00', 'ooo', '2016-01-01 00:00:00'),
('30', 'PT MANDIRI', 'BPN', 'ID', 'aaa', 'bbbb', 'kkk', 'dfgdfgvdfgdfgdfgd', 'eee', 43, 'ww', '0', '2010-01-01', 'avatar.png', 'Customer', 'fdgdfg', 'dfg', '2016-01-01 00:00:00', 'ooo', '2016-01-01 00:00:00'),
('31', 'BANK BCA', 'BPN', 'ID', 'aaa', 'bbbb', 'kkk', 'dfgdfgvdfgdfgdfgd', 'eee', 98, 'ww', '1', '2010-01-01', 'avatar.png', 'Prospect', 'fdgdfg', 'dfg', '2016-01-01 00:00:00', 'ooo', '2016-01-01 00:00:00'),
('32', 'BRI COMPANY', 'CGK', 'ID', 'aaa', 'bbbb', 'kkk', 'dfgdfgvdfgdfgdfgd', 'eee', 44, 'ww', '1', '2010-01-01', 'avatar.png', 'Customer ', 'fdgdfg', 'dfg', '2016-01-01 00:00:00', 'ooo', '2016-01-01 00:00:00'),
('33', 'PT AXYS', 'CGK', 'ID', 'ff', 'qqqq', 'ssss', 'dfgdfgvdfgdfgdfgd', 'ddd', 4, 'dfgdfg', '0', '2010-01-01', 'avatar.png', 'Prospect', 'fdgdfg', 'dfg', '2016-01-01 00:00:00', 'pppp', '2016-01-01 00:00:00'),
('34', 'PT INDOFOOD', 'CGK', 'ID', 'aaa', 'bbbb', 'kkk', 'dfgdfgvdfgdfgdfgd', 'eee', 34, 'ww', '1', '2010-01-01', 'avatar.png', 'Prospect', 'fdgdfg', 'dfg', '2016-01-01 00:00:00', 'ooo', '2016-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `trcust_inquiry`
--

CREATE TABLE `trcust_inquiry` (
  `Id` varchar(20) NOT NULL DEFAULT '',
  `IdCustHeader` varchar(20) NOT NULL DEFAULT '',
  `IdCouOri` char(2) NOT NULL DEFAULT '',
  `IdCityOri` char(3) NOT NULL DEFAULT '',
  `IdPortOri` varchar(5) NOT NULL DEFAULT '',
  `IdCouDest` char(2) NOT NULL DEFAULT '',
  `IdCityDest` char(3) NOT NULL DEFAULT '',
  `IdPortDest` varchar(5) NOT NULL DEFAULT '',
  `AddressOri` text,
  `ZipcodeOri` varchar(10) DEFAULT NULL,
  `AddressDest` text,
  `ZipcodeDest` tinytext,
  `IdService` varchar(10) NOT NULL DEFAULT '' COMMENT 'link msservice: Land,Airfreight,seafreith',
  `LoadingType` varchar(10) DEFAULT NULL COMMENT 'pilihan :FCL/LCL (terisi jika seafreith)',
  `Incoterm` varchar(50) NOT NULL DEFAULT '' COMMENT 'pilihan data2 incoterm (fixed)',
  `TypeService` varchar(50) DEFAULT NULL COMMENT 'pilihan tipe service (fixed) : PortToPort, PortToDoor, DoorToPort, DoorToDoor',
  `OtherReq` text,
  `DateOfAvailable` date DEFAULT NULL COMMENT 'Tgl tersedia barang',
  `IdCommodity` varchar(10) NOT NULL DEFAULT '',
  `DescGoods` text,
  `Qty` int(4) NOT NULL DEFAULT '0',
  `Weight` double DEFAULT NULL,
  `Length` double DEFAULT NULL,
  `Width` double DEFAULT NULL,
  `Height` double DEFAULT NULL,
  `Volume` double DEFAULT NULL,
  `FileUpload1` varchar(200) DEFAULT NULL,
  `FileUpload2` varchar(200) DEFAULT NULL,
  `FileUpload3` varchar(200) DEFAULT NULL,
  `FileUpload4` varchar(200) DEFAULT NULL,
  `AdditionalInf` text,
  `CreatedBy` varchar(50) NOT NULL DEFAULT '',
  `CreatedDate` datetime NOT NULL DEFAULT '2010-01-01 00:00:00',
  `ModifiedBy` varchar(50) NOT NULL DEFAULT '',
  `ModifiedDate` datetime NOT NULL DEFAULT '2010-01-01 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `msaddr_type`
--
ALTER TABLE `msaddr_type`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `msbusiness_type`
--
ALTER TABLE `msbusiness_type`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `mscity`
--
ALTER TABLE `mscity`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `mscommodity`
--
ALTER TABLE `mscommodity`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `mscountry`
--
ALTER TABLE `mscountry`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `mscurrency`
--
ALTER TABLE `mscurrency`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `msport`
--
ALTER TABLE `msport`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdCty` (`IdCity`),
  ADD KEY `IdService` (`IdService`),
  ADD KEY `Codes` (`Codes`);

--
-- Indexes for table `msregion`
--
ALTER TABLE `msregion`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `msservice`
--
ALTER TABLE `msservice`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdServiceCategory` (`IdServiceCategory`);

--
-- Indexes for table `msservice_category`
--
ALTER TABLE `msservice_category`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `msvat_type`
--
ALTER TABLE `msvat_type`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `trcust_dtlaccounting`
--
ALTER TABLE `trcust_dtlaccounting`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `trcust_dtladdress`
--
ALTER TABLE `trcust_dtladdress`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdCompHeader` (`IdCustHeader`);

--
-- Indexes for table `trcust_dtlbilling`
--
ALTER TABLE `trcust_dtlbilling`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `trcust_dtlbusiness`
--
ALTER TABLE `trcust_dtlbusiness`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `trcust_dtlcomm`
--
ALTER TABLE `trcust_dtlcomm`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `trcust_dtlcompetitor`
--
ALTER TABLE `trcust_dtlcompetitor`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `trcust_dtlcompetitor_service`
--
ALTER TABLE `trcust_dtlcompetitor_service`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `trcust_dtlcontact`
--
ALTER TABLE `trcust_dtlcontact`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `trcust_dtlcontact_active`
--
ALTER TABLE `trcust_dtlcontact_active`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `trcust_dtlphoto`
--
ALTER TABLE `trcust_dtlphoto`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdCompHeader` (`IdCustHeader`);

--
-- Indexes for table `trcust_dtlsales`
--
ALTER TABLE `trcust_dtlsales`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `trcust_dtlservice`
--
ALTER TABLE `trcust_dtlservice`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdCompHeader` (`IdCustHeader`),
  ADD KEY `IdProdHeader` (`IdService`);

--
-- Indexes for table `trcust_hdr`
--
ALTER TABLE `trcust_hdr`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdCountry` (`IdCountry`),
  ADD KEY `IdCity` (`IdCity`);

--
-- Indexes for table `trcust_inquiry`
--
ALTER TABLE `trcust_inquiry`
  ADD PRIMARY KEY (`Id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `msport`
--
ALTER TABLE `msport`
  ADD CONSTRAINT `msport_ibfk_2` FOREIGN KEY (`IdService`) REFERENCES `msservice` (`Id`);

--
-- Constraints for table `msservice`
--
ALTER TABLE `msservice`
  ADD CONSTRAINT `msservice_ibfk_1` FOREIGN KEY (`IdServiceCategory`) REFERENCES `msservice_category` (`Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
