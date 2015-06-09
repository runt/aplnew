select drueck.`PersNr`,drueck.`Stück`,drueck.`Auss-Stück`
from drueck
where drueck.persnr between '1402' and '1402'
 and drueck.datum between '2009-08-01' and '2009-08-31'
group by drueck.persnr