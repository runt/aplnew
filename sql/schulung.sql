select
    dpersschulung.schulung_id,
    dschulung.beschreibung,
    DATE_FORMAT(dpersschulung.letzte_datum,'%d.%m.%Y') as letzte_datum,
    dpersschulung.persnr,
    DATE_FORMAT(DATE_ADD(dpersschulung.letzte_datum,INTERVAL dschulung.interval_monate MONTH),'%d.%m.%Y') as naechste_datum,
    DATE_FORMAT(DATE_ADD(dpersschulung.letzte_datum,INTERVAL 10*12 MONTH),'%d.%m.%Y') as naechste_datum1
from dpersschulung
join dschulung on dschulung.id=dpersschulung.schulung_id
where
    dpersschulung.letzte_datum between '2011-01-01' and '2011-01-01' + INTERVAL 5 MONTH
group by
    dpersschulung.schulung_id,
    dpersschulung.letzte_datum,
    dpersschulung.persnr
