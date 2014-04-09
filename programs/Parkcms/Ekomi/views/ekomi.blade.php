<div class="rating" itemscope="itemscope" itemtype="http://schema.org/LocalBusiness">
    <span itemprop="name">{{ $ekomi->name }}</span>
    <a href="{{ $ekomi->link }}" target="_blank">
        <div style="position: relative; margin: 0 20px;">
            <div style="border: 1px solid #7888AA;">
                <div itemprop="aggregateRating" itemscope="itemscope" itemtype="http://schema.org/AggregateRating" style="width: {{ $ekomi->rating / 5 * 100 }}%; background-color: #7099E5; height: 21px; text-align: center; font-weight: bold; padding: 2px 0;">
                    <span style="position: relative; line-height: 10px; display: block; z-index: 2;"><span itemprop="ratingValue">{{ round($ekomi->rating, 1) }}</span>/5</span>
                    <span style="position: relative; line-height: 10px; font-size: 6pt; z-index: 20; color: #e3e3e3; display: block;"><span itemprop="reviewCount">{{ $ekomi->count }}</span> Bewertungen</span>
                </div>
                <div style="position: absolute; top: 0; left: 20%; width: 1px; height: 23px; background-color: #7888AA; z-index: 1;"></div>
                <div style="position: absolute; top: 0; left: 40%; width: 1px; height: 23px; background-color: #7888AA; z-index: 1;"></div>
                <div style="position: absolute; top: 0; left: 60%; width: 1px; height: 23px; background-color: #7888AA; z-index: 1;"></div>
                <div style="position: absolute; top: 0; left: 80%; width: 1px; height: 23px; background-color: #7888AA; z-index: 1;"></div>
            </div>
        </div>
    </a>
</div>
