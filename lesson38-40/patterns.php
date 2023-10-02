<?php
$yearRegex = '/<a href="year\/.{1,}?">(.{1,}?) года<\/a>/u';
$countryRegex = '/<a href="country\/.{1,}?">(.{1,}?)<\/a>/u';
$genreRegex = '/<span itemprop="genre">(.{1,}?)<\/span>/u';
$durationRegex = '/<td itemprop="duration">(.{1,}?) мин\.<\/td>/u';
$actorRegex = '/<span.{1,}?itemprop="actor".{1,}?>.{1,}?<span itemprop="name">(.{1,}?)<\/span>.{1,}?<\/span>/u';