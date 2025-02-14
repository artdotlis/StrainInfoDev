import type { JSX } from 'preact';
import GrAb from '@assets/dia/gr_ab.webp';

function AboutIluVD(): JSX.Element {
    /** not loading="lazy" because of cls */
    return <img height="535" src={GrAb} alt="Background" />;
}

export default AboutIluVD;
